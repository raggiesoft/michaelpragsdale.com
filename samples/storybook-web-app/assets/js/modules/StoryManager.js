// assets/js/modules/StoryManager.js

export class StoryManager {
    constructor(dataService, contentRenderer, uiManager, hudManager, navigationManagerGetter) {
        this.dataService = dataService;
        this.contentRenderer = contentRenderer;
        this.uiManager = uiManager;
        this.hudManager = hudManager;
        this.navigationManagerGetter = navigationManagerGetter; // A function to get NavigationManager

        this.currentSeriesId = null;
        this.masterBookData = {};    // Holds the content of the selected series' book.json
        this.charactersData = {};  // Holds characters for the selected series
        this.locationsData = {};   // Holds locations for the selected series
        
        this.flatChapterOrder = []; 
        this.currentGlobalChapterIndex = 0;
        // console.log("StoryManager: Initialized.");
    }

    setCurrentSeriesId(seriesId) {
        this.currentSeriesId = seriesId;
    }

    getCurrentSeriesId() {
        return this.currentSeriesId;
    }

    getCurrentCharactersData() {
        return this.charactersData;
    }

    getCurrentLocationsData() {
        return this.locationsData;
    }
    
    resetCurrentSeries() {
        this.currentSeriesId = null;
        this.masterBookData = {};
        this.charactersData = {};
        this.locationsData = {};
        this.flatChapterOrder = [];
        this.currentGlobalChapterIndex = 0;
        console.log("StoryManager: Current series reset.");
    }

    async loadSeries(seriesDisplayTitle) { // seriesId is now set via setCurrentSeriesId
        if (!this.currentSeriesId) {
            console.error("StoryManager.loadSeries: currentSeriesId is not set prior to calling loadSeries.");
            this.uiManager.displayErrorMessage("Cannot load series: Series ID missing.");
            return false;
        }
        
        const masterManifestPath = `books/${this.currentSeriesId}/book.json`;
        const charactersPath = `books/${this.currentSeriesId}/characters.json`;
        const locationsPath = `books/${this.currentSeriesId}/locations.json`;

        // console.log(`StoryManager: Attempting to load series "${seriesDisplayTitle}" (ID: "${this.currentSeriesId}")`);
        this.uiManager.setMainAppTitle(seriesDisplayTitle); 
        this.uiManager.displayLoadingMessage(`Workspaceing data for "${seriesDisplayTitle}"...`);

        try {
            this.masterBookData = await this.dataService.loadSeriesBookData(this.currentSeriesId);
            this.charactersData = await this.dataService.loadSeriesCharactersData(this.currentSeriesId);
            this.locationsData = await this.dataService.loadSeriesLocationsData(this.currentSeriesId);
            
            // console.log("StoryManager: Series Book Data Loaded. Title:", this.masterBookData.seriesTitle);
            
            this.generateFlatChapterOrderForSeries(); 
            this.contentRenderer.populateTableOfContentsForSeries(this.flatChapterOrder, this.currentSeriesId, this.masterBookData, this.currentGlobalChapterIndex); 
            
            return true; // Indicate success for main.js to proceed
        } catch (error) {
            console.error(`StoryManager: Error loading story series data for "${seriesDisplayTitle}":`, error);
            this.uiManager.displayErrorMessage(`Error loading: ${seriesDisplayTitle}. ${error.message}.`);
            // UIManager should handle reverting to library view if main.js calls it based on this return
            return false;
        }
    }
    
    generateFlatChapterOrderForSeries() {
        this.flatChapterOrder = [];
        if (!this.masterBookData || !this.currentSeriesId) { 
            console.warn("StoryManager.generateFlatChapterOrder: masterBookData or currentSeriesId missing.");
            return; 
        }
        
        // Series Introduction (standardized path)
        this.flatChapterOrder.push({
            seriesId: this.currentSeriesId, volumeKey: null, chapterKey: 'series_introduction', 
            title: this.masterBookData.seriesTitle || "Introduction", 
            filePath: `books/${this.currentSeriesId}/introduction.md`, 
            isSeriesIntroduction: true, isVolumeIntroduction: false 
            // initialHudStatus is derived from the MD file itself by HudManager/ContentRenderer
        });

        if (this.masterBookData.volumes) {
            Object.keys(this.masterBookData.volumes).sort().forEach(volumeKey => {
                const volume = this.masterBookData.volumes[volumeKey];
                if (volume && volume.title && volume.chapters) {
                    let volBasePath = volume.basePath || ''; 
                    if (volBasePath && !volBasePath.endsWith('/')) { volBasePath += '/'; }
                    const actualVolumeRootPath = `books/${this.currentSeriesId}/story/${volBasePath}`; 
                    
                    this.flatChapterOrder.push({ // Volume Introduction
                        seriesId: this.currentSeriesId, volumeKey: volumeKey, chapterKey: `${volumeKey}_intro`, 
                        title: volume.title + " - Introduction", 
                        filePath: `${actualVolumeRootPath}volume_intro.md`, 
                        isSeriesIntroduction: false, isVolumeIntroduction: true,
                        volumeTitle: volume.title 
                    });

                    Object.keys(volume.chapters).forEach(chapterKey => { 
                        const chapter = volume.chapters[chapterKey];
                        if (!chapter || !chapter.filePath || !chapter.title) { 
                            console.warn(`StoryManager.generateFlatChapterOrder: Skipping malformed chapter ${chapterKey} in volume ${volumeKey}`);
                            return; 
                        }
                        const cleanChapterFileName = chapter.filePath.startsWith('/') ? chapter.filePath.substring(1) : chapter.filePath;
                        this.flatChapterOrder.push({
                            seriesId: this.currentSeriesId, volumeKey: volumeKey, volumeTitle: volume.title,
                            chapterKey: chapterKey, title: chapter.title,
                            filePath: `${actualVolumeRootPath}scenes/${cleanChapterFileName}`, 
                            isSeriesIntroduction: false, isVolumeIntroduction: false
                        });
                    });
                } else {
                    console.warn(`StoryManager.generateFlatChapterOrder: Volume ${volumeKey} missing title or chapters.`);
                }
            });
        }
        // console.log("StoryManager.generateFlatChapterOrderForSeries: Final flatChapterOrder:", this.flatChapterOrder);
    }
    
    getFlatChapterOrder() {
        return this.flatChapterOrder;
    }

    getCurrentChapterIndex() {
        return this.currentGlobalChapterIndex;
    }
    
    setCurrentChapterByIndex(index) {
        if (index >= 0 && index < this.flatChapterOrder.length) {
            this.currentGlobalChapterIndex = index;
        } else {
            console.warn(`StoryManager.setCurrentChapterByIndex: Invalid index ${index}. Setting to 0.`);
            this.currentGlobalChapterIndex = 0; 
        }
    }

    async loadScene(updateHash = true) { 
        if (this.flatChapterOrder.length === 0 || this.currentGlobalChapterIndex < 0 || this.currentGlobalChapterIndex >= this.flatChapterOrder.length) {
            this.uiManager.displayErrorMessage("Error: No chapter available or index out of bounds.");
            this.uiManager.updateNextPrevButtons(this.flatChapterOrder, this.currentGlobalChapterIndex);
            return;
        }
        const chapterDetail = this.flatChapterOrder[this.currentGlobalChapterIndex]; 
        if (!chapterDetail || !chapterDetail.filePath) { 
            this.uiManager.displayErrorMessage("Error: Chapter data is invalid (missing filePath)."); 
            return; 
        }

        this.uiManager.updateSceneTitle(chapterDetail.title);
        this.uiManager.setMainAppTitle(this.masterBookData.seriesTitle ? `${this.masterBookData.seriesTitle}: ${chapterDetail.title}` : chapterDetail.title);
        
        if (updateHash) {
            const navigationManager = this.navigationManagerGetter(); // Get NavigationManager instance
            if (navigationManager) {
                navigationManager.updateURLHashForChapter(chapterDetail);
            } else if (chapterDetail.chapterKey && window.location.hash !== `#chapter-${chapterDetail.chapterKey}`) {
                // Fallback if navigationManager isn't available (should not happen in normal flow)
                window.location.hash = `#chapter-${chapterDetail.chapterKey}`;
            }
        }
        
        this.uiManager.displayLoadingMessage(`Loading "${chapterDetail.title}"...`);
        
        try {
            const markdownContent = await this.dataService.fetchChapterContent(chapterDetail.filePath); 
            this.contentRenderer.renderScene(chapterDetail, markdownContent); 
        } catch (error) { 
            console.error(`StoryManager.loadScene: Failed to load/parse ${chapterDetail.filePath}:`, error); 
            this.uiManager.displayErrorMessage(`Error loading content for "${chapterDetail.title}": ${error.message}`);
        }
        this.uiManager.updateActiveChapterInSidebar(this.flatChapterOrder, this.currentGlobalChapterIndex);
        this.uiManager.updateNextPrevButtons(this.flatChapterOrder, this.currentGlobalChapterIndex);
    }

    navigateChapterByOffset(direction) { 
        const currentItem = this.flatChapterOrder[this.currentGlobalChapterIndex];
        if (!currentItem) {
            console.warn("navigateChapterByOffset: No current item, cannot navigate.");
            return;
        }
        let nextPotentialIndex = this.currentGlobalChapterIndex + direction;

        if (direction > 0) { // Going "Next"
            if (currentItem.isSeriesIntroduction){ 
                const firstVolumeKey = Object.keys(this.masterBookData.volumes || {})[0];
                nextPotentialIndex = this.flatChapterOrder.findIndex(ch => ch.isVolumeIntroduction && ch.volumeKey === firstVolumeKey);
                if(nextPotentialIndex === -1) { // No volume intros, try first actual chapter of first volume
                     const firstActualChapter = this.flatChapterOrder.find(ch => !ch.isSeriesIntroduction && !ch.isVolumeIntroduction && ch.volumeKey === firstVolumeKey);
                     if(firstActualChapter) nextPotentialIndex = this.flatChapterOrder.indexOf(firstActualChapter);
                     else nextPotentialIndex = this.currentGlobalChapterIndex + 1; // Default progression
                }
            } else if (currentItem.isVolumeIntroduction) {
                 const firstChapterOfThisVolumeIndex = this.flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction);
                if (firstChapterOfThisVolumeIndex !== -1) nextPotentialIndex = firstChapterOfThisVolumeIndex;
                else nextPotentialIndex = this.currentGlobalChapterIndex + 1; // Should go to next volume's intro or end
            } else { // On a regular chapter
                const isLastChapterInVolume = !this.flatChapterOrder.some((ch, idx) => idx > this.currentGlobalChapterIndex && ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction);
                if (isLastChapterInVolume) {
                    let foundNextVolumeIntro = false;
                    for (let i = this.currentGlobalChapterIndex + 1; i < this.flatChapterOrder.length; i++) {
                        if (this.flatChapterOrder[i].volumeKey !== currentItem.volumeKey && this.flatChapterOrder[i].isVolumeIntroduction) { 
                            nextPotentialIndex = i; foundNextVolumeIntro = true; break;
                        }
                    }
                    if(!foundNextVolumeIntro) { // If no next volume intro, means end of series (or last chapter of last book)
                        nextPotentialIndex = this.currentGlobalChapterIndex + 1; // Let boundary check handle it
                    }
                }
            }
        } else { // Going "Previous"
            if (currentItem && !currentItem.isSeriesIntroduction && !currentItem.isVolumeIntroduction) {
                const firstChapterOfThisVolumeIndex = this.flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction);
                if (this.currentGlobalChapterIndex === firstChapterOfThisVolumeIndex) {
                    const volumeIntroIndex = this.flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && ch.isVolumeIntroduction);
                    if (volumeIntroIndex !== -1) nextPotentialIndex = volumeIntroIndex;
                    else nextPotentialIndex = this.currentGlobalChapterIndex -1; // Should not happen
                }
            } else if (currentItem && currentItem.isVolumeIntroduction) {
                const seriesIntroIndex = this.flatChapterOrder.findIndex(ch => ch.isSeriesIntroduction && ch.seriesId === this.currentSeriesId);
                let previousTargetIndex = seriesIntroIndex !== -1 ? seriesIntroIndex : 0; 

                const currentVolumeOrder = Object.keys(this.masterBookData.volumes || {}).sort();
                const currentVolumeJsonIndex = currentVolumeOrder.indexOf(currentItem.volumeKey);

                if (currentVolumeJsonIndex > 0) { 
                    const prevVolumeKey = currentVolumeOrder[currentVolumeJsonIndex - 1];
                    for(let i = this.currentGlobalChapterIndex - 1; i >=0; i--){
                        if(this.flatChapterOrder[i].volumeKey === prevVolumeKey && !this.flatChapterOrder[i].isVolumeIntroduction && !this.flatChapterOrder[i].isSeriesIntroduction) {
                            previousTargetIndex = i; break; 
                        }
                    }
                } 
                nextPotentialIndex = previousTargetIndex;
            } else if (currentItem && currentItem.isSeriesIntroduction) { 
                nextPotentialIndex = 0; 
            }
        }
        
        if (nextPotentialIndex >= 0 && nextPotentialIndex < this.flatChapterOrder.length) { 
            const targetChapter = this.flatChapterOrder[nextPotentialIndex];
            if(targetChapter && targetChapter.chapterKey){ 
                const navigationManager = this.navigationManagerGetter();
                if (navigationManager) {
                    navigationManager.updateURLHashForChapter(targetChapter);
                } else { // Fallback if navigationManager instance isn't available through getter yet
                     window.location.hash = `#chapter-${targetChapter.chapterKey}`;
                }
            } 
        } 
    }
}