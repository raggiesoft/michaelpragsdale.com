// assets/js/modules/NavigationManager.js

export class NavigationManager {
    constructor(storyManager, uiManager, dataService) {
        this.storyManager = storyManager;
        this.uiManager = uiManager;
        this.dataService = dataService;
        // console.log("NavigationManager: Initialized.");
    }

    parseHash(hashString) {
        if (!hashString || hashString.length < 2) return null;
        const params = new URLSearchParams(hashString.substring(1));
        const seriesId = params.get('series');
        const chapterKey = params.get('chapter');

        if (seriesId && chapterKey) {
            return { seriesId, chapterKey };
        } else if (!seriesId && chapterKey) { 
            // For handling internal navigation that might still use simpler hash temporarily,
            // or if series context is already firmly established.
            // However, for deep linking, seriesId is crucial.
            return { seriesId: this.storyManager.getCurrentSeriesId(), chapterKey: chapterKey };
        } else if (hashString.startsWith('#chapter-')) { // Legacy support during transition
             const legacyChapterKey = hashString.substring('#chapter-'.length);
             return { seriesId: this.storyManager.getCurrentSeriesId(), chapterKey: legacyChapterKey };
        }
        return null;
    }

    handleHashChange(isCalledByStoryLoad = false) {
        const currentSeriesId = this.storyManager.getCurrentSeriesId();
        const flatChapterOrder = this.storyManager.getFlatChapterOrder();
        
        // console.log("NavigationManager.handleHashChange: Hash is now", window.location.hash, "SeriesID:", currentSeriesId, "isCalledByStoryLoad:", isCalledByStoryLoad);

        if (!currentSeriesId || !flatChapterOrder || flatChapterOrder.length === 0) { 
            if (!isCalledByStoryLoad && window.location.hash === '') {
                this.uiManager.showLibraryView();
                const libData = this.dataService.getCachedLibraryData();
                if (libData && libData.applicationTitle && this.uiManager.mainAppTitleElement) {
                    this.uiManager.setMainAppTitle(libData.applicationTitle);
                }
            }
            return; 
        }

        const deepLinkInfo = this.parseHash(window.location.hash);
        let targetIndex = -1;

        if (deepLinkInfo && deepLinkInfo.seriesId === currentSeriesId && deepLinkInfo.chapterKey) {
            targetIndex = flatChapterOrder.findIndex(ch => ch.chapterKey === deepLinkInfo.chapterKey); // seriesId already matched
        } else { 
            targetIndex = flatChapterOrder.findIndex(ch => ch.isSeriesIntroduction);
            if (targetIndex === -1) targetIndex = 0;
        }
        
        if (targetIndex !== -1) {
            if (targetIndex !== this.storyManager.getCurrentChapterIndex() || isCalledByStoryLoad) {
                this.storyManager.setCurrentChapterByIndex(targetIndex);
                this.storyManager.loadScene(false); 
            }
        } else {
            console.warn("NavigationManager.handleHashChange: Could not determine valid target index from hash:", window.location.hash);
            this.storyManager.setCurrentChapterByIndex(0); // Default to intro
            this.storyManager.loadScene(true); // Update hash to reflect this default
        }
    }

    navigateToLibrary(defaultAppTitle) {
        window.location.hash = ''; 
        this.uiManager.showLibraryView();
        if (defaultAppTitle) {
            this.uiManager.setMainAppTitle(defaultAppTitle);
        }
        console.log("NavigationManager: Navigated back to library view.");
    }
    
    processInitialHashOrLoadDefault() {
        // console.log("NavigationManager.processInitialHashOrLoadDefault: Processing for series:", this.storyManager.getCurrentSeriesId());
        this.handleHashChange(true); 
    }

    /**
     * Updates the URL hash to reflect the current chapter using the new preferred format.
     * @param {object} chapterDetail - The detail object of the chapter to link to.
     * Must have seriesId and chapterKey.
     */
    updateURLHashForChapter(chapterDetail) {
        if (chapterDetail && chapterDetail.seriesId && chapterDetail.chapterKey) {
            const newHash = `#series=${chapterDetail.seriesId}&chapter=${chapterDetail.chapterKey}`;
            if (window.location.hash !== newHash) {
                window.location.hash = newHash;
                 console.log("NavigationManager.updateURLHashForChapter: Hash updated to", newHash);
            }
        } else {
            console.warn("NavigationManager.updateURLHashForChapter: Invalid chapterDetail provided or missing seriesId/chapterKey:", chapterDetail);
            // Optionally clear hash or set to series intro if chapter detail is bad
            // For now, do nothing if detail is invalid to prevent unwanted hash changes.
        }
    }
}