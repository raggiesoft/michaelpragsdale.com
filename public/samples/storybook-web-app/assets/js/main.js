// assets/js/main.js

import { UIManager } from './modules/UIManager.js';
import { DataService } from './modules/DataService.js';
import { StoryManager } from './modules/StoryManager.js';
import { ContentRenderer } from './modules/ContentRenderer.js';
import { CodexManager } from './modules/CodexManager.js';
import { HudManager } from './modules/HudManager.js';
import { NavigationManager } from './modules/NavigationManager.js';

console.log("main.js: Script loaded, modules imported.");

document.addEventListener('DOMContentLoaded', () => {
    console.log("main.js - DOMContentLoaded: DOM fully loaded and parsed.");

    // --- DOM Element References ---
    const domElements = {
        mainAppTitle: document.getElementById('main-app-title'),
        libraryView: document.getElementById('library-view'),
        libraryGrid: document.getElementById('library-grid'),
        storyView: document.getElementById('story-view'),
        sceneTitle: document.getElementById('scene-title'),
        sceneText: document.getElementById('scene-text'),
        menuToggle: document.getElementById('menu-toggle'),
        sidebar: document.getElementById('sidebar'),
        sidebarCloseButton: document.getElementById('sidebar-close-button'),
        tableOfContents: document.getElementById('table-of-contents'),
        overlay: document.getElementById('overlay'),
        prevButton: document.getElementById('prev-button'),
        nextButton: document.getElementById('next-button'),
        codexModal: document.getElementById('codex-modal'),
        codexToggle: document.getElementById('codex-toggle'),
        codexCloseButton: document.getElementById('codex-close-button'),
        codexSearchInput: document.getElementById('codex-search-input'),
        codexItemsContainer: document.getElementById('codex-items-container'),
        codexPaginationContainer: document.getElementById('codex-list-pagination'),
        codexDetailPane: document.getElementById('codex-detail-pane'),
        codexTabButtons: document.querySelectorAll('.codex-tab-button'),
        backToLibraryButton: document.getElementById('back-to-library-button'),
        hudStatusDisplay: document.getElementById('hud-status-display'),
        // Ensure UIManager gets a reference to the tabs container if it needs to manage its visibility
        codexTabsContainer: document.getElementById('codex-tabs-container'), 
        codexListWrapper: document.getElementById('codex-list-wrapper') 
    };

    if (!domElements.libraryGrid) {
        console.error("main.js - initializeApp: CRITICAL - libraryGridElement NOT FOUND. Halting.");
        document.body.innerHTML = `<p style="color:red; padding:20px; font-size:1.2em; text-align:center;">App Error: #library-grid missing from HTML. Please verify index.html.</p>`;
        return; 
    }

    // --- Instantiate Managers/Services ---
    const uiManager = new UIManager(domElements);
    const dataService = new DataService(); 
    const hudManager = new HudManager(domElements.hudStatusDisplay, domElements.sceneText);
    const contentRenderer = new ContentRenderer(domElements.sceneText, domElements.tableOfContents, hudManager);
    
    let navigationManager; 
    const storyManager = new StoryManager(dataService, contentRenderer, uiManager, hudManager, 
        () => navigationManager 
    ); 
    navigationManager = new NavigationManager(storyManager, uiManager, dataService); 
    const codexManager = new CodexManager(domElements, uiManager); 

    // --- Helper for Deep Linking ---
    function parseDeepLinkHash(hashString) {
        if (!hashString || hashString.length < 2) return null; 
        const params = new URLSearchParams(hashString.substring(1)); 
        const seriesId = params.get('series');
        const chapterKey = params.get('chapter');
        if (seriesId && chapterKey) {
            return { seriesId, chapterKey };
        } else if (!seriesId && chapterKey) { 
            // This case means a chapter was specified but not a series.
            // For initial deep link, series is needed.
            // This might be used by handleHashChange if a series is already active.
            return { seriesId: null, chapterKey: chapterKey };
        }
        return null;
    }
    
    // Callback for when a series is selected from the library view
    async function librarySeriesSelectCallback(selectedSeries) {
        console.log("main.js: Series selected from library - ", selectedSeries.title);
        if (window.location.hash) { 
            history.pushState("", document.title, window.location.pathname + window.location.search);
        }
        storyManager.setCurrentSeriesId(selectedSeries.id);
        const seriesLoaded = await storyManager.loadSeries(selectedSeries.title); 
        if (seriesLoaded) {
            codexManager.setCodexData(
                storyManager.getCurrentSeriesId(),
                storyManager.getCurrentCharactersData(), 
                storyManager.getCurrentLocationsData()
            );
            navigationManager.processInitialHashOrLoadDefault(); 
            uiManager.showStoryView();
        } else {
            uiManager.showLibraryView();
        }
    }

    // --- Initialize Application ---
    async function initializeApp() {
        console.log("main.js - initializeApp: Starting application initialization...");
        uiManager.checkDarkMode(); 
        
        const libraryDataFromService = await dataService.loadLibraryManifest(); 

        if (libraryDataFromService && domElements.libraryGrid) { 
            uiManager.setMainAppTitle(libraryDataFromService.applicationTitle);
            
            let deepLinkInfo = parseDeepLinkHash(window.location.hash);
            console.log("main.js - initializeApp: Parsed deepLinkInfo from initial hash:", deepLinkInfo);

            if (deepLinkInfo && deepLinkInfo.seriesId) {
                const seriesToLoad = libraryDataFromService.storySeries.find(s => s.id === deepLinkInfo.seriesId);
                if (seriesToLoad) {
                    console.log("main.js - initializeApp: Attempting to deep link to series:", seriesToLoad.title);
                    storyManager.setCurrentSeriesId(seriesToLoad.id); 
                    const seriesLoaded = await storyManager.loadSeries(seriesToLoad.title);
                    if (seriesLoaded) {
                        codexManager.setCodexData(storyManager.getCurrentSeriesId(), storyManager.getCurrentCharactersData(), storyManager.getCurrentLocationsData());
                        navigationManager.processInitialHashOrLoadDefault(); 
                        uiManager.showStoryView();
                    } else {
                        console.warn("main.js - initializeApp: Deep linked series failed to load. Showing library.");
                        contentRenderer.populateLibraryView(libraryDataFromService.storySeries, domElements.libraryGrid, librarySeriesSelectCallback);
                        uiManager.showLibraryView();
                    }
                } else {
                    console.warn(`main.js - initializeApp: Series ID "${deepLinkInfo.seriesId}" from deep link not found in library. Showing library.`);
                    contentRenderer.populateLibraryView(libraryDataFromService.storySeries, domElements.libraryGrid, librarySeriesSelectCallback);
                    uiManager.showLibraryView();
                }
            } else {
                console.log("main.js - initializeApp: No valid deep link hash with seriesId on initial load. Showing library view.");
                contentRenderer.populateLibraryView(libraryDataFromService.storySeries, domElements.libraryGrid, librarySeriesSelectCallback);
                uiManager.showLibraryView();
            }

            // --- Global Event Listeners ---
            if(domElements.menuToggle) domElements.menuToggle.addEventListener('click', (e) => { e.stopPropagation(); uiManager.toggleSidebar(); });
            if(domElements.overlay) domElements.overlay.addEventListener('click', () => { uiManager.toggleSidebar(false); });
            if(domElements.sidebarCloseButton) domElements.sidebarCloseButton.addEventListener('click', () => { uiManager.toggleSidebar(false); });
            
            if(domElements.backToLibraryButton) { 
                domElements.backToLibraryButton.addEventListener('click', () => { 
                    navigationManager.navigateToLibrary(dataService.getCachedLibraryData()?.applicationTitle); 
                    storyManager.resetCurrentSeries();
                    codexManager.resetCodexData();
                    hudManager.resetHud();
                });
            }
            
            if(domElements.codexToggle) domElements.codexToggle.addEventListener('click', (e) => { 
                if (!storyManager.getCurrentSeriesId()) { alert("Please select a story series first to view its Codex."); return; } 
                e.stopPropagation(); uiManager.toggleCodexModal(true, codexManager); 
            });
            if(domElements.codexCloseButton) domElements.codexCloseButton.addEventListener('click', () => uiManager.toggleCodexModal(false, codexManager));
            if(domElements.codexModal) domElements.codexModal.addEventListener('click', (e) => { if (e.target.id === 'codex-modal') uiManager.toggleCodexModal(false, codexManager); });
            
            // Codex search and tab clicks are handled internally by CodexManager's #attachStaticListeners
            
            if(domElements.prevButton) domElements.prevButton.addEventListener('click', () => storyManager.navigateChapterByOffset(-1));
            if(domElements.nextButton) domElements.nextButton.addEventListener('click', () => storyManager.navigateChapterByOffset(1));
            
            window.addEventListener('hashchange', () => navigationManager.handleHashChange());
            
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => uiManager.checkDarkMode());
            console.log("main.js - initializeApp: Core UI event listeners attached.");
        } else { 
            console.error("main.js - initializeApp: Library manifest failed to load. Application cannot proceed.");
            if(domElements.mainAppTitle) domElements.mainAppTitle.textContent = "Reader Error";
        }
    }

    initializeApp();
});