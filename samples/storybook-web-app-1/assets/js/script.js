document.addEventListener('DOMContentLoaded', () => {
    console.log("DOM fully loaded. Initializing RaggieSoft Storybook Reader (v.RegexFixed_Properly).");

    // --- Global State Variables ---
    let libraryData = {};
    let currentSeriesId = null;
    let masterBookData = {}; 
    let charactersData = {};
    let locationsData = {};
    let flatChapterOrder = []; 
    let currentGlobalChapterIndex = 0;

    // --- DOM Element Variables ---
    let mainAppTitleElement, libraryViewElement, libraryGridElement, storyViewElement, 
        sceneTitleElement, sceneTextElement, menuToggle, sidebar, sidebarCloseButton, 
        tableOfContentsElement, overlay, prevButton, nextButton, codexModal, 
        codexToggle, codexCloseButton, codexSearchInput, codexItemsContainer, 
        codexPaginationContainer, codexDetailPane, backToLibraryButton,
        hudStatusDisplayElement;
    
    let codexTabButtons; 

    // --- Codex State ---
    let currentCodexTab = 'characters';
    let selectedCodexItemKey = null;
    let codexCurrentPage = 1;
    const CODEX_ITEMS_PER_PAGE = 10; 
    let currentFilteredCodexItems = []; 

    // --- HUD State ---
    let currentHudStatus = {}; 
    let chapterInitialHudStatus = null; 
    let hudIntersectionObserver = null;
    let lastActivatedHudTrigger = null; 

    function assignGlobalDomElements() {
        mainAppTitleElement = document.getElementById('main-app-title');
        libraryViewElement = document.getElementById('library-view');
        libraryGridElement = document.getElementById('library-grid'); 
        storyViewElement = document.getElementById('story-view');
        sceneTitleElement = document.getElementById('scene-title');
        sceneTextElement = document.getElementById('scene-text');
        menuToggle = document.getElementById('menu-toggle');
        sidebar = document.getElementById('sidebar');
        sidebarCloseButton = document.getElementById('sidebar-close-button');
        tableOfContentsElement = document.getElementById('table-of-contents');
        overlay = document.getElementById('overlay');
        prevButton = document.getElementById('prev-button');
        nextButton = document.getElementById('next-button');
        codexModal = document.getElementById('codex-modal');
        codexToggle = document.getElementById('codex-toggle');
        codexCloseButton = document.getElementById('codex-close-button');
        codexSearchInput = document.getElementById('codex-search-input'); 
        codexItemsContainer = document.getElementById('codex-items-container'); 
        codexPaginationContainer = document.getElementById('codex-list-pagination'); 
        codexDetailPane = document.getElementById('codex-detail-pane');
        codexTabButtons = document.querySelectorAll('.codex-tab-button');
        backToLibraryButton = document.getElementById('back-to-library-button');
        hudStatusDisplayElement = document.getElementById('hud-status-display');
        if (!libraryGridElement) console.error("assignGlobalDomElements: libraryGridElement is NULL!");
        if (!hudStatusDisplayElement) console.warn("assignGlobalDomElements: hudStatusDisplayElement is NULL!");
    }

    async function loadLibraryManifest() {
        try {
            const response = await fetch('assets/json/library.json');
            if (!response.ok) throw new Error(`Library Data: ${response.statusText} (${response.url})`);
            libraryData = await response.json();
            if (mainAppTitleElement && libraryData.applicationTitle) {
                mainAppTitleElement.textContent = libraryData.applicationTitle;
                document.title = libraryData.applicationTitle;
            }
            const libViewH2 = document.querySelector('#library-view h2'); 
            if (libViewH2) { libViewH2.textContent = "Choose Your Saga"; }
            populateLibraryView(libraryData.storySeries);
            showLibraryView();
            return true;
        } catch (error) {
            console.error("Error loading library.json:", error);
            if (libraryGridElement) { libraryGridElement.innerHTML = `<p class="error-message col-span-full text-center">Error loading library.</p>`; } 
            else { const b = document.querySelector('body'); if (b) b.innerHTML = `<p class="error-message p-10 text-center">UI missing.</p>`; }
            return false;
        }
    }

    function populateLibraryView(storySeriesArray) {
        if (!libraryGridElement) { return; }
        libraryGridElement.innerHTML = ''; 
        if (!storySeriesArray || storySeriesArray.length === 0) { libraryGridElement.innerHTML = `<p>No story series found.</p>`; return; }
        storySeriesArray.forEach(series => {
            if (!series.id || !series.title) { return; }
            const card = document.createElement('div');
            card.className = "p-4 rounded-lg shadow-lg cursor-pointer transition-all duration-300 ease-in-out hover:shadow-2xl hover:scale-105 border flex flex-col";
            card.style.backgroundColor = 'var(--color-bg-secondary)'; card.style.borderColor = 'var(--color-border)';
            card.setAttribute('data-series-id', series.id); 
            const seriesId = series.id; const coverImageUrl = `books/${seriesId}/cover.png`; 
            const coverSection = document.createElement('div');
            coverSection.className = "w-full h-48 rounded-t-lg mb-4 relative bg-[var(--color-bg-button)] flex-shrink-0"; 
            const img = document.createElement('img'); img.src = coverImageUrl; img.alt = `${series.title} Cover`;
            img.className = "absolute inset-0 w-full h-full object-cover rounded-t-lg";
            const placeholder = document.createElement('div');
            placeholder.className = "no-cover-placeholder absolute inset-0 w-full h-full flex items-center justify-center text-[var(--color-text-secondary)] rounded-t-lg";
            placeholder.textContent = "Cover Art Missing"; placeholder.style.display = 'none'; 
            img.onerror = () => { img.style.display = 'none'; placeholder.style.display = 'flex'; };
            img.onload = () => { placeholder.style.display = 'none'; img.style.display = 'block'; };
            coverSection.appendChild(img); coverSection.appendChild(placeholder); card.appendChild(coverSection);
            const textContentDiv = document.createElement('div'); textContentDiv.className = "flex flex-col flex-grow";
            const titleEl = document.createElement('h3'); titleEl.className = "text-xl font-bold mb-2 text-[var(--color-text-primary)]";
            titleEl.textContent = series.title; textContentDiv.appendChild(titleEl);
            const descEl = document.createElement('p'); descEl.className = "text-sm text-[var(--color-text-secondary)] mb-4 flex-grow";
            descEl.textContent = series.description || 'No description available.'; textContentDiv.appendChild(descEl);
            const button = document.createElement('button'); button.className = "read-series-button w-full font-bold py-2 px-4 rounded transition duration-200 mt-auto flex-shrink-0";
            button.textContent = "Read This Saga";
            button.style.backgroundColor = 'var(--color-accent)'; button.style.color = 'var(--color-text-white)';
            button.onmouseover = () => { if(button) button.style.backgroundColor = 'var(--color-accent-hover)'; };
            button.onmouseout = () => { if(button) button.style.backgroundColor = 'var(--color-accent)'; };
            button.addEventListener('click', () => { currentSeriesId = series.id; if (window.location.hash) { history.pushState("", document.title, window.location.pathname + window.location.search); } loadStorySeriesData(series.title); });
            textContentDiv.appendChild(button); card.appendChild(textContentDiv);
            libraryGridElement.appendChild(card);
        });
    }

    function showLibraryView() { 
        if (libraryViewElement) libraryViewElement.classList.remove('hidden');
        if (storyViewElement) storyViewElement.classList.add('hidden');
        if (menuToggle) menuToggle.classList.add('hidden'); 
        if (codexToggle) codexToggle.classList.add('hidden'); 
        if (backToLibraryButton) backToLibraryButton.classList.add('hidden');
        if (hudStatusDisplayElement) hudStatusDisplayElement.classList.add('hidden');
    }

    function showStoryView() { 
        if (libraryViewElement) libraryViewElement.classList.add('hidden');
        if (storyViewElement) storyViewElement.classList.remove('hidden');
        if (menuToggle) menuToggle.classList.remove('hidden'); 
        if (codexToggle) codexToggle.classList.remove('hidden'); 
        if (backToLibraryButton) backToLibraryButton.classList.remove('hidden');
    }

    async function loadStorySeriesData(seriesDisplayTitle) {
        if (!currentSeriesId) { showLibraryView(); return; }
        const masterManifestPath = `books/${currentSeriesId}/book.json`;
        const charactersPath = `books/${currentSeriesId}/characters.json`;
        const locationsPath = `books/${currentSeriesId}/locations.json`;
        if(mainAppTitleElement) mainAppTitleElement.textContent = seriesDisplayTitle; 
        if(sceneTextElement) sceneTextElement.innerHTML = `<p class="p-4">Fetching data for "${seriesDisplayTitle}"...</p>`;
        try {
            const [bookResponse, charsResponse, locsResponse] = await Promise.all([
                fetch(masterManifestPath), fetch(charactersPath), fetch(locationsPath)
            ]);
            if (!bookResponse.ok) throw new Error(`Book Manifest (${masterManifestPath}): ${bookResponse.statusText}`);
            masterBookData = await bookResponse.json(); 
            if (!charsResponse.ok) throw new Error(`Characters (${charactersPath}): ${charsResponse.statusText}`);
            charactersData = await charsResponse.json(); 
            if (!locsResponse.ok) throw new Error(`Locations (${locationsPath}): ${locsResponse.statusText}`);
            locationsData = await locsResponse.json(); 
            generateFlatChapterOrderForSeries(); 
            populateTableOfContentsForSeries(); 
            currentGlobalChapterIndex = 0; 
            handleHashChange(true); 
            showStoryView();
        } catch (error) {
            console.error(`Error loading series data for "${seriesDisplayTitle}":`, error);
            if (sceneTextElement) sceneTextElement.innerHTML = `<p class="error-message p-4">Error loading: ${seriesDisplayTitle}.<br>${error.message}.</p>`;
            showLibraryView(); 
            if(mainAppTitleElement && libraryData.applicationTitle) mainAppTitleElement.textContent = libraryData.applicationTitle;
            if(libraryData.applicationTitle) document.title = libraryData.applicationTitle;
        }
    }
    
    function generateFlatChapterOrderForSeries() {
        flatChapterOrder = [];
        if (!masterBookData || !currentSeriesId) { return; }
        flatChapterOrder.push({
            seriesId: currentSeriesId, volumeKey: null, chapterKey: 'series_introduction', 
            title: masterBookData.seriesTitle || "Introduction", 
            filePath: `books/${currentSeriesId}/introduction.md`, 
            isSeriesIntroduction: true, isVolumeIntroduction: false 
        });
        if (masterBookData.volumes) {
            Object.keys(masterBookData.volumes).sort().forEach(volumeKey => {
                const volume = masterBookData.volumes[volumeKey];
                if (volume && volume.title && volume.chapters) {
                    let volBasePath = volume.basePath || ''; 
                    if (volBasePath && !volBasePath.endsWith('/')) { volBasePath += '/'; }
                    const actualVolumeRootPath = `books/${currentSeriesId}/story/${volBasePath}`; 
                    flatChapterOrder.push({
                        seriesId: currentSeriesId, volumeKey: volumeKey, chapterKey: `${volumeKey}_intro`, 
                        title: volume.title + " - Introduction", 
                        filePath: `${actualVolumeRootPath}volume_intro.md`, 
                        isSeriesIntroduction: false, isVolumeIntroduction: true,
                        volumeTitle: volume.title 
                    });
                    Object.keys(volume.chapters).forEach(chapterKey => { 
                        const chapter = volume.chapters[chapterKey];
                        if (!chapter || !chapter.filePath || !chapter.title) { return; }
                        const cleanChapterFileName = chapter.filePath.startsWith('/') ? chapter.filePath.substring(1) : chapter.filePath;
                        flatChapterOrder.push({
                            seriesId: currentSeriesId, volumeKey: volumeKey, volumeTitle: volume.title,
                            chapterKey: chapterKey, title: chapter.title,
                            filePath: `${actualVolumeRootPath}scenes/${cleanChapterFileName}`, 
                            isSeriesIntroduction: false, isVolumeIntroduction: false
                        });
                    });
                }
            });
        }
    }
    
    function populateTableOfContentsForSeries() {
        if (!tableOfContentsElement || flatChapterOrder.length === 0 ) {
             tableOfContentsElement.innerHTML = '<p class="p-4 text-sm">No content.</p>'; return;
        }
        tableOfContentsElement.innerHTML = '';
        const seriesIntroEntry = flatChapterOrder.find(ch => ch.isSeriesIntroduction && ch.seriesId === currentSeriesId);
        if (seriesIntroEntry) {
            const link = document.createElement('a');
            link.href = `#chapter-${seriesIntroEntry.chapterKey}`; 
            link.textContent = seriesIntroEntry.title; 
            link.classList.add('chapter-link', 'font-bold', 'text-lg', 'block', 'px-6', 'py-3'); 
            tableOfContentsElement.appendChild(link);
        }
        const volumesForToC = {};
        flatChapterOrder.forEach((chapterDetail) => {
            if (chapterDetail.volumeKey && chapterDetail.seriesId === currentSeriesId) { 
                if (!volumesForToC[chapterDetail.volumeKey]) {
                    const volIntroIndex = flatChapterOrder.findIndex(ch => ch.volumeKey === chapterDetail.volumeKey && ch.isVolumeIntroduction && ch.seriesId === currentSeriesId);
                    volumesForToC[chapterDetail.volumeKey] = { 
                        title: chapterDetail.volumeTitle, chapters: [],
                        volumeIntroChapterKey: volIntroIndex !== -1 ? flatChapterOrder[volIntroIndex].chapterKey : null
                    };
                }
                if (!chapterDetail.isVolumeIntroduction && !chapterDetail.isSeriesIntroduction) {
                    volumesForToC[chapterDetail.volumeKey].chapters.push(chapterDetail);
                }
            }
        });
        Object.keys(volumesForToC).sort().forEach(volumeKey => {
            const volume = volumesForToC[volumeKey];
            if (!volume.title) { return; }
            const bookDetails = document.createElement('details'); 
            bookDetails.className = 'book-section';
            bookDetails.dataset.volumeKey = volumeKey;
            const currentChapterDetails = flatChapterOrder[currentGlobalChapterIndex];
            if (currentChapterDetails && currentChapterDetails.volumeKey === volumeKey) bookDetails.open = true;
            const bookSummary = document.createElement('summary'); 
            bookSummary.className = 'book-title-summary';
            const summaryLink = document.createElement('a');
            summaryLink.style.cssText = 'display:flex; justify-content:space-between; width:100%; text-decoration:none; color:inherit;';
            summaryLink.innerHTML = `<span>${volume.title}</span><span class="arrow"><i class="fa-duotone fa-chevron-right fa-xs fa-fw book-arrow-icon" aria-hidden="true"></i></span>`;
            if (volume.volumeIntroChapterKey) { summaryLink.href = `#chapter-${volume.volumeIntroChapterKey}`; } 
            else { summaryLink.href = '#'; } 
            bookSummary.appendChild(summaryLink); bookDetails.appendChild(bookSummary);
            const chapterListUl = document.createElement('ul'); 
            chapterListUl.className = 'chapter-list-nested';
            if (bookDetails.open) { 
                chapterListUl.classList.add('open');
                const arrowIcon = bookSummary.querySelector('.book-arrow-icon');
                if(arrowIcon){ arrowIcon.classList.remove('fa-chevron-right'); arrowIcon.classList.add('fa-chevron-down'); }
                bookSummary.classList.add('open');
            }
            volume.chapters.sort((a,b) => a.title.localeCompare(b.title)).forEach(chapterInVolume => {
                const chapterLi = document.createElement('li'); 
                const link = document.createElement('a');
                link.href = `#chapter-${chapterInVolume.chapterKey}`; 
                link.textContent = chapterInVolume.title; 
                link.classList.add('chapter-link');
                const globalIdx = flatChapterOrder.indexOf(chapterInVolume);
                link.dataset.globalIndex = globalIdx;
                chapterLi.appendChild(link); 
                chapterListUl.appendChild(chapterLi);
            });
            bookDetails.appendChild(chapterListUl); 
            tableOfContentsElement.appendChild(bookDetails);
        });
        tableOfContentsElement.querySelectorAll('.book-title-summary').forEach(summary => {
             summary.addEventListener('click', function(e) { 
                const linkElement = summary.querySelector('a');
                if (linkElement && e.target.closest('a') === linkElement && linkElement.getAttribute('href') !== '#') {} 
                else { e.preventDefault(); }
                const detailsElement = this.parentElement;
                if (detailsElement.tagName === 'DETAILS') {
                    const isOpenCurrently = detailsElement.hasAttribute('open');
                    let shouldToggleManually = (linkElement.getAttribute('href') === '#' || e.target.closest('a') !== linkElement);
                    if (shouldToggleManually) { if (isOpenCurrently) { detailsElement.removeAttribute('open'); } else { detailsElement.setAttribute('open', ''); } } 
                    else if (!isOpenCurrently) { detailsElement.setAttribute('open', ''); }
                    tableOfContentsElement.querySelectorAll('details.book-section').forEach(otherDetails => {
                        if (otherDetails !== detailsElement && otherDetails.open) {
                            otherDetails.removeAttribute('open');
                            const s = otherDetails.querySelector('.book-title-summary');
                            const i = s ? s.querySelector('.book-arrow-icon') : null;
                            const ul = otherDetails.querySelector('.chapter-list-nested');
                            if(s) s.classList.remove('open'); if(ul) ul.classList.remove('open');
                            if(i) { i.classList.remove('fa-chevron-down'); i.classList.add('fa-chevron-right'); }
                        }
                    });
                    setTimeout(() => { 
                        const isOpenAfterToggle = detailsElement.open; this.classList.toggle('open', isOpenAfterToggle);
                        const icon = this.querySelector('.book-arrow-icon');
                        if (icon) { icon.classList.toggle('fa-chevron-right', !isOpenAfterToggle); icon.classList.toggle('fa-chevron-down', isOpenAfterToggle); }
                        const chapterList = this.nextElementSibling;
                        if (chapterList) { chapterList.classList.toggle('open', isOpenAfterToggle); }
                    }, 0);
                }
             });
        });
        updateActiveChapterInSidebar();
    }
    
    // --- HUD Functions ---
    function updateHudDisplay(statusData) {
        if (!hudStatusDisplayElement) return;
        if (!statusData || Object.keys(statusData).length === 0) {
            hudStatusDisplayElement.classList.add('hidden');
            currentHudStatus = {}; return;
        }
        currentHudStatus = { ...currentHudStatus, ...statusData }; 
        hudStatusDisplayElement.classList.remove('hidden');
        let statsContainer = hudStatusDisplayElement.querySelector('#hud-stats-container');
        if (!statsContainer) {
            const titleElement = hudStatusDisplayElement.querySelector('h4');
            statsContainer = document.createElement('div'); statsContainer.id = 'hud-stats-container';
            if (titleElement && titleElement.nextSibling) hudStatusDisplayElement.insertBefore(statsContainer, titleElement.nextSibling);
            else if (titleElement) hudStatusDisplayElement.appendChild(statsContainer);
            else hudStatusDisplayElement.prepend(statsContainer);
        }
        statsContainer.innerHTML = ''; 
        const hudType = currentHudStatus.type || "System"; 
        const hudTitleElement = hudStatusDisplayElement.querySelector('h4');
        if(hudTitleElement) {
            hudTitleElement.textContent = `${hudType.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())} Status:`;
        }
        for (const key in currentHudStatus) {
            if (currentHudStatus.hasOwnProperty(key) && key !== 'type' && key !== 'alertText') {
                const statDiv = document.createElement('div');
                const label = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                statDiv.innerHTML = `${label}: <span class="font-medium">${currentHudStatus[key]}</span>`;
                const valueSpan = statDiv.querySelector('span');
                if(valueSpan){
                    const valueText = String(currentHudStatus[key]).toLowerCase();
                    if (valueText.includes("critical") || valueText.includes("failing") || valueText.includes("empty") || valueText.includes("low") || valueText.includes("disabled") || valueText.includes("unstable")) {
                        valueSpan.style.color = 'var(--color-error)';
                    } else if (valueText.includes("nominal") || valueText.includes("high") || valueText.includes("full") || valueText.includes("stable") || valueText.includes("online")) {
                         valueSpan.style.color = 'var(--color-accent)'; 
                    } else { 
                         valueSpan.style.color = document.documentElement.classList.contains('dark') ? 'var(--color-text-primary)' : 'var(--color-text-secondary)';
                    }
                }
                statsContainer.appendChild(statDiv);
            }
        }
        const alertTextElement = document.getElementById('hud-alert-text');
        if (alertTextElement) {
            if (currentHudStatus.alertText && currentHudStatus.alertText.trim() !== "") {
                alertTextElement.textContent = currentHudStatus.alertText;
                alertTextElement.classList.remove('hidden');
            } else {
                alertTextElement.textContent = ''; 
                alertTextElement.classList.add('hidden'); 
            }
        }
    }

	//const statusRegexGlobal = new RegExp("", "gi");
	//const firstCommentRegex = new RegExp("^\\s*", "i");
	
	function preprocessMarkdownForHudTriggers(markdownContent) {
    console.log("🔍 Starting preprocessMarkdownForHudTriggers...");
    console.log("📜 Raw Markdown Content Received:\n", markdownContent);

    // Regex to detect JSON objects inside HUD comments
    const hudJsonRegex = /<!--\s*RGS_HUD_UPDATE:\s*(\{.*?\})\s*-->/gi;

    let firstStatusCommentData = null;
    let processedContent = markdownContent;

    // Extract the first HUD JSON for initial status
    const firstMatchResult = markdownContent.match(hudJsonRegex);
    console.log("🔎 First HUD Match Found:\n", firstMatchResult);

    if (firstMatchResult && firstMatchResult.length > 0) {
        let jsonString = firstMatchResult[0].replace(/<!--\s*RGS_HUD_UPDATE:\s*/, '').replace(/\s*-->/, '').trim();
        console.log("🛠 Extracted JSON String from First HUD Comment:\n", jsonString);

        try {
            firstStatusCommentData = JSON.parse(jsonString);
            console.log("✅ Successfully Parsed Initial HUD JSON:\n", firstStatusCommentData);
        } catch (error) {
            console.error("❌ JSON Parsing Error (Initial HUD):\n", error, "\nProblematic JSON:", jsonString);
            firstStatusCommentData = null;
        }
    }

    // Replace ALL HUD comments with interactive HUD trigger spans
    processedContent = markdownContent.replace(hudJsonRegex, (fullMatch, jsonString) => {
        console.log("🔄 Processing HUD Comment:\n", fullMatch);
        console.log("🛠 Extracted JSON Content:\n", jsonString);

        try {
            JSON.parse(jsonString); // Validate JSON before injecting
            const escapedJsonString = jsonString.replace(/'/g, "&apos;").replace(/"/g, "&quot;");
            console.log("✅ JSON is valid! Injecting HUD trigger...");
            return `<span class="hud-trigger" data-status='${escapedJsonString}'>HUD Update</span>`;
        } catch (error) {
            console.error("❌ JSON Parsing Error in Replacement:\n", error, "\nProblematic JSON:", jsonString);
            return ''; // Remove malformed comment instead of breaking
        }
    });

    console.log("✅ Final Processed Markdown Content:\n", processedContent);
    return { processedContent, initialStatusFromMarkdown: firstStatusCommentData };
}

    function setupHudIntersectionObserver() {
        if (hudIntersectionObserver) { hudIntersectionObserver.disconnect(); }
        lastActivatedHudTrigger = null; 
        if (!sceneTextElement) return;
        const triggers = sceneTextElement.querySelectorAll('.hud-trigger');
        if (triggers.length === 0) { updateHudDisplay(chapterInitialHudStatus || null); return; }
        const options = { root: sceneTextElement, rootMargin: "-48% 0px -48% 0px", threshold: 0.01 };
        hudIntersectionObserver = new IntersectionObserver((entries) => {
            let highestInView = null; let minTop = Infinity;
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.boundingClientRect.top < minTop) { minTop = entry.boundingClientRect.top; highestInView = entry.target; }
                }
            });
            if (!highestInView) {
                let mostRecentlyPassedTrigger = null; let maxBottom = -Infinity; 
                triggers.forEach(trigger => {
                    const rect = trigger.getBoundingClientRect(); const sceneRect = sceneTextElement.getBoundingClientRect();
                    if (rect.bottom < (sceneRect.top + sceneRect.height * 0.5) && rect.bottom > maxBottom) {
                        maxBottom = rect.bottom; mostRecentlyPassedTrigger = trigger;
                    }
                });
                highestInView = mostRecentlyPassedTrigger;
            }
            if (highestInView) {
                if (highestInView !== lastActivatedHudTrigger) {
                    try {
                        const statusJsonString = highestInView.dataset.status.replace(/&apos;/g, "'").replace(/&quot;/g, '"');
                        const status = JSON.parse(statusJsonString); updateHudDisplay(status);
                        lastActivatedHudTrigger = highestInView;
                    } catch (e) { console.error("Error parsing status JSON from trigger:", e); }
                }
            } else if (lastActivatedHudTrigger !== 'initial_status_applied' && chapterInitialHudStatus) {
                updateHudDisplay(chapterInitialHudStatus); lastActivatedHudTrigger = 'initial_status_applied'; 
            } else if (!chapterInitialHudStatus && !highestInView) {
                updateHudDisplay(null); lastActivatedHudTrigger = null;
            }
        }, options);
        triggers.forEach(trigger => hudIntersectionObserver.observe(trigger));
    }

    async function loadScene(updateHash = true) { 
        if (hudIntersectionObserver) { hudIntersectionObserver.disconnect(); hudIntersectionObserver = null; }
        lastActivatedHudTrigger = null; 
        if (flatChapterOrder.length === 0 || currentGlobalChapterIndex < 0 || currentGlobalChapterIndex >= flatChapterOrder.length) {
            if(sceneTextElement) sceneTextElement.innerHTML = `<p class="error-message">Error: No chapter.</p>`;
            if(sceneTitleElement) sceneTitleElement.textContent = "Error";
            if(prevButton) prevButton.disabled = true; if(nextButton) nextButton.disabled = true; return;
        }
        const chapterDetail = flatChapterOrder[currentGlobalChapterIndex]; 
        if (!chapterDetail || !chapterDetail.filePath) { 
            if(sceneTextElement) sceneTextElement.innerHTML = `<p class="error-message">Error: Chapter data invalid.</p>`; return; 
        }
        if(sceneTitleElement) sceneTitleElement.textContent = chapterDetail.title;
        if (masterBookData && masterBookData.seriesTitle) { document.title = `${masterBookData.seriesTitle}: ${chapterDetail.title}`; } 
        else { document.title = `Adrift: ${chapterDetail.title}`; }
        if (updateHash && chapterDetail.chapterKey) { const newHash = `#chapter-${chapterDetail.chapterKey}`; if (window.location.hash !== newHash) { window.location.hash = newHash; } }
        if(sceneTextElement) sceneTextElement.innerHTML = `<p>Loading "${chapterDetail.title}"...</p>`;
        chapterInitialHudStatus = null; 
        try {
            const response = await fetch(chapterDetail.filePath); 
            if (!response.ok) { throw new Error(`HTTP error! Status: ${response.status} for ${chapterDetail.filePath}`); }
            let markdownContent = await response.text();
            const { processedContent, initialStatusFromMarkdown } = preprocessMarkdownForHudTriggers(markdownContent);
            chapterInitialHudStatus = initialStatusFromMarkdown || null; 
            updateHudDisplay(chapterInitialHudStatus); 
            let htmlContent = (typeof window.marked !== 'undefined' && typeof window.marked.parse === 'function') 
                ? window.marked.parse(processedContent) 
                : processedContent.split('\n').map(l => l.trim()).filter(l => l).map(p => `<p>${p}</p>`).join('');
            if(sceneTextElement) { sceneTextElement.innerHTML = htmlContent; setupHudIntersectionObserver(); }
        } catch (error) { 
            console.error(`Failed to load/parse ${chapterDetail.filePath}:`, error); 
            if(sceneTextElement) sceneTextElement.innerHTML = `<p class="error-message">Error loading: "${chapterDetail.title}".</p>`;
        }
        updateActiveChapterInSidebar();
        if(prevButton) prevButton.disabled = (currentGlobalChapterIndex === 0);
        if(nextButton) nextButton.disabled = (currentGlobalChapterIndex === flatChapterOrder.length - 1);
        if(sceneTextElement) sceneTextElement.scrollTop = 0;
    }
    
    function handleHashChange(isInitialSeriesLoad = false) { 
        if (!currentSeriesId || flatChapterOrder.length === 0) { 
            if (isInitialSeriesLoad && currentSeriesId && flatChapterOrder.length > 0 && !window.location.hash && flatChapterOrder[0]?.isSeriesIntroduction) { 
                currentGlobalChapterIndex = 0; loadScene(true); 
            } return; 
        } 
        const hash = window.location.hash; 
        let targetIndex = -1; 
        if (hash && hash.startsWith("#chapter-")) { 
            const chapterKeyFromHash = hash.substring("#chapter-".length); 
            targetIndex = flatChapterOrder.findIndex(ch => ch.chapterKey === chapterKeyFromHash && ch.seriesId === currentSeriesId); 
            if (targetIndex === -1) { 
                targetIndex = flatChapterOrder.findIndex(ch => ch.isSeriesIntroduction && ch.seriesId === currentSeriesId); 
                if (targetIndex === -1) targetIndex = 0; 
            } 
        } else if (currentSeriesId && flatChapterOrder.length > 0) { 
            targetIndex = flatChapterOrder.findIndex(ch => ch.isSeriesIntroduction && ch.seriesId === currentSeriesId); 
            if (targetIndex === -1) targetIndex = 0; 
        } 
        if (targetIndex !== -1 && (targetIndex !== currentGlobalChapterIndex || isInitialSeriesLoad) ) { 
            currentGlobalChapterIndex = targetIndex; 
            loadScene(false); 
        } else if (targetIndex !== -1 && targetIndex === currentGlobalChapterIndex && isInitialSeriesLoad && sceneTextElement && (sceneTextElement.textContent.includes("Loading chapter content...") || sceneTextElement.textContent.includes("Fetching series data for") ) ) { 
            loadScene(false);
        } 
    }
    
    function updateActiveChapterInSidebar() { if (tableOfContentsElement && flatChapterOrder.length > 0) { tableOfContentsElement.querySelectorAll('.chapter-link').forEach(link => { const linkGlobalIndex = link.dataset.globalIndex; if (linkGlobalIndex !== undefined) { link.classList.toggle('active', parseInt(linkGlobalIndex, 10) === currentGlobalChapterIndex); }}); const currentChapterDetail = flatChapterOrder[currentGlobalChapterIndex]; if(currentChapterDetail && currentChapterDetail.volumeKey){ tableOfContentsElement.querySelectorAll('details.book-section').forEach(detailsEl => { const summary = detailsEl.querySelector('.book-title-summary'); const icon = summary ? summary.querySelector('.book-arrow-icon') : null; const ul = detailsEl.querySelector('.chapter-list-nested'); const shouldBeOpen = detailsEl.dataset.volumeKey === currentChapterDetail.volumeKey; if (detailsEl.open !== shouldBeOpen) { if (shouldBeOpen) detailsEl.setAttribute('open', ''); else detailsEl.removeAttribute('open'); } if(summary) summary.classList.toggle('open', shouldBeOpen); if(ul) ul.classList.toggle('open', shouldBeOpen); if(icon) { icon.classList.toggle('fa-chevron-right', !shouldBeOpen); icon.classList.toggle('fa-chevron-down', shouldBeOpen); } });}}}
    
    function navigateChapter(direction) { const currentItem = flatChapterOrder[currentGlobalChapterIndex]; let nextPotentialIndex = currentGlobalChapterIndex + direction; if (direction > 0) { if (currentItem && (currentItem.isSeriesIntroduction || currentItem.isVolumeIntroduction)) { if(currentItem.isSeriesIntroduction){ const firstVolIntroIndex = flatChapterOrder.findIndex(ch => ch.isVolumeIntroduction && ch.seriesId === currentSeriesId && ch.volumeKey === Object.keys(masterBookData.volumes || {})[0]); if(firstVolIntroIndex !== -1) nextPotentialIndex = firstVolIntroIndex; else { const firstActualChapter = flatChapterOrder.find(ch => !ch.isSeriesIntroduction && !ch.isVolumeIntroduction && ch.seriesId === currentSeriesId && ch.volumeKey === Object.keys(masterBookData.volumes || {})[0]); if(firstActualChapter) nextPotentialIndex = flatChapterOrder.indexOf(firstActualChapter); else nextPotentialIndex = currentGlobalChapterIndex + 1; }} else if (currentItem.isVolumeIntroduction && currentItem.volumeKey) { const firstChapterOfThisVolumeIndex = flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction); if (firstChapterOfThisVolumeIndex !== -1) nextPotentialIndex = firstChapterOfThisVolumeIndex; else nextPotentialIndex = currentGlobalChapterIndex + 1;}} else if (currentItem && !currentItem.isSeriesIntroduction && !currentItem.isVolumeIntroduction) { const isLastChapterInVolume = !flatChapterOrder.some((ch, idx) => idx > currentGlobalChapterIndex && ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction); if (isLastChapterInVolume) { let foundNext = false; for (let i = currentGlobalChapterIndex + 1; i < flatChapterOrder.length; i++) { if (flatChapterOrder[i].volumeKey !== currentItem.volumeKey && flatChapterOrder[i].isVolumeIntroduction) { nextPotentialIndex = i; foundNext = true; break;} else if (flatChapterOrder[i].volumeKey !== currentItem.volumeKey && !flatChapterOrder[i].isSeriesIntroduction && !flatChapterOrder[i].isVolumeIntroduction){ nextPotentialIndex = i; foundNext = true; break;}} if(!foundNext) nextPotentialIndex = currentGlobalChapterIndex + 1;}}} else { if (currentItem && !currentItem.isSeriesIntroduction && !currentItem.isVolumeIntroduction) { const firstChapterOfThisVolumeIndex = flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && !ch.isVolumeIntroduction && !ch.isSeriesIntroduction); if (currentGlobalChapterIndex === firstChapterOfThisVolumeIndex) { const volumeIntroIndex = flatChapterOrder.findIndex(ch => ch.volumeKey === currentItem.volumeKey && ch.isVolumeIntroduction); if (volumeIntroIndex !== -1) nextPotentialIndex = volumeIntroIndex; else nextPotentialIndex = currentGlobalChapterIndex -1;}} else if (currentItem && currentItem.isVolumeIntroduction) { const currentVolumeKey = currentItem.volumeKey; let previousTargetIndex = -1; for(let i = currentGlobalChapterIndex -1; i >=0; i--){ if(flatChapterOrder[i].volumeKey !== currentVolumeKey && !flatChapterOrder[i].isVolumeIntroduction && !flatChapterOrder[i].isSeriesIntroduction){ previousTargetIndex = i; break; } else if(flatChapterOrder[i].isSeriesIntroduction) { previousTargetIndex = i; break;}} if(previousTargetIndex !== -1){ nextPotentialIndex = previousTargetIndex; } else { const seriesIntroIndex = flatChapterOrder.findIndex(ch => ch.isSeriesIntroduction); if(seriesIntroIndex !== -1) nextPotentialIndex = seriesIntroIndex; else nextPotentialIndex = 0; }} else if (currentItem && currentItem.isSeriesIntroduction) { nextPotentialIndex = 0;}} if (nextPotentialIndex >= 0 && nextPotentialIndex < flatChapterOrder.length) { const targetChapter = flatChapterOrder[nextPotentialIndex]; if(targetChapter && targetChapter.chapterKey){ window.location.hash = `#chapter-${targetChapter.chapterKey}`; if(window.location.hash === `#chapter-${targetChapter.chapterKey}` && nextPotentialIndex !== currentGlobalChapterIndex) { currentGlobalChapterIndex = nextPotentialIndex; loadScene(false); } else if (nextPotentialIndex === currentGlobalChapterIndex && window.location.hash !== `#chapter-${targetChapter.chapterKey}`) { window.location.hash = `#chapter-${targetChapter.chapterKey}`;}}}}
    
    function toggleSidebar(forceState = null) { if (!sidebar || !overlay) return; const isLg = window.matchMedia('(min-width: 1024px)').matches; let show; if (forceState !== null) { show = forceState; } else { show = isLg ? true : sidebar.classList.contains('-translate-x-full');} if (isLg) { overlay.classList.add('hidden'); sidebar.classList.remove('-translate-x-full'); sidebar.classList.add('translate-x-0'); } else { if (show) { sidebar.classList.remove('-translate-x-full'); sidebar.classList.add('translate-x-0'); overlay.classList.remove('hidden'); } else { sidebar.classList.add('-translate-x-full'); sidebar.classList.remove('translate-x-0'); overlay.classList.add('hidden');}}}
    function checkDarkMode() { const isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches; document.documentElement.classList.toggle('dark', isDark); }
    function toggleCodexModal(show) {if (!codexModal) { return; } const isCurrentlyHidden = codexModal.classList.contains('hidden'); if (show) { if (isCurrentlyHidden) { codexModal.classList.remove('hidden'); const activeTabButton = document.querySelector(`.codex-tab-button[data-tab="${currentCodexTab}"]`) || document.querySelector('.codex-tab-button'); if (activeTabButton) { codexTabButtons.forEach(btn => btn.classList.remove('active')); activeTabButton.classList.add('active'); currentCodexTab = activeTabButton.dataset.tab; } else { currentCodexTab = 'characters'; const dTab = document.querySelector('.codex-tab-button[data-tab="characters"]'); if(dTab) dTab.classList.add('active');} const sInput = document.getElementById('codex-search-input'); if(sInput) { sInput.value = ''; sInput.placeholder = `Search ${currentCodexTab}...`; codexSearchInput = sInput; } else {console.warn("toggleCodexModal couldn't find codex-search-input");} codexCurrentPage = 1; selectedCodexItemKey = null; updateFullCodexView();  if (codexDetailPane) codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item from the list.</p>`; }} else { if (!isCurrentlyHidden) codexModal.classList.add('hidden'); } }
    function getAllCodexItemsForCurrentTab() { let allItems = []; if (currentCodexTab === 'characters') { if (charactersData && typeof charactersData === 'object') { Object.keys(charactersData).forEach(category => { if (charactersData[category] && typeof charactersData[category] === 'object') { Object.keys(charactersData[category]).forEach(lastName => { if (charactersData[category][lastName] && typeof charactersData[category][lastName] === 'object') { Object.keys(charactersData[category][lastName]).forEach(charKey => { const item = charactersData[category][lastName][charKey]; if(item && item.name){ allItems.push({ ...item, id: `${category}-${lastName}-${charKey}`, type: 'character',categoryName: category.charAt(0).toUpperCase() + category.slice(1), subCategoryName: lastName }); } }); } }); } }); } } else if (currentCodexTab === 'locations') { if (locationsData && typeof locationsData === 'object') { Object.keys(locationsData).forEach(key => { const item = locationsData[key]; if(item && item.name){ allItems.push({ ...item, id: key, type: 'location' }); } }); } } return allItems.sort((a, b) => { if (a.categoryName && b.categoryName && a.categoryName !== b.categoryName) { return a.categoryName.localeCompare(b.categoryName); } return a.name.localeCompare(b.name); }); }
    function updateFullCodexView() { const sInput = document.getElementById('codex-search-input'); const itemsContainer = document.getElementById('codex-items-container'); const paginationContainer = document.getElementById('codex-list-pagination'); if (!itemsContainer || !paginationContainer || !sInput) { console.warn("updateFullCodexView missing one or more critical codex elements."); return; } codexSearchInput = sInput; codexItemsContainer = itemsContainer; codexPaginationContainer = paginationContainer; const searchTerm = codexSearchInput.value.toLowerCase(); const allItemsForTab = getAllCodexItemsForCurrentTab(); currentFilteredCodexItems = allItemsForTab.filter(item => { if (!item || !item.name) return false; const nameMatch = item.name.toLowerCase().includes(searchTerm); const catMatch = currentCodexTab === 'characters' && item.categoryName ? item.categoryName.toLowerCase().includes(searchTerm) : false; const subCatMatch = currentCodexTab === 'characters' && item.subCategoryName ? item.subCategoryName.toLowerCase().includes(searchTerm) : false; const typeMatch = currentCodexTab === 'locations' && item.type ? item.type.toLowerCase().includes(searchTerm) : false; return nameMatch || catMatch || subCatMatch || typeMatch; }); renderCodexListPageItems(); renderCodexListPaginationControls(); }
    function renderCodexListPageItems() { const itemsContainer = document.getElementById('codex-items-container'); if (!itemsContainer) {return;} itemsContainer.innerHTML = ''; itemsContainer.scrollTop = 0; const start = (codexCurrentPage - 1) * CODEX_ITEMS_PER_PAGE; const end = start + CODEX_ITEMS_PER_PAGE; const pageItems = currentFilteredCodexItems.slice(start, end); if (pageItems.length === 0) { if (codexSearchInput && codexSearchInput.value) { itemsContainer.innerHTML = `<p class="p-3 text-sm text-[var(--color-text-secondary)]">No results for "${codexSearchInput.value}".</p>`; } else { itemsContainer.innerHTML = `<p class="p-3 text-sm text-[var(--color-text-secondary)]">No items.</p>`; } return; } if (currentCodexTab === 'characters') { let currentCat = null; pageItems.forEach(item => { if (item.categoryName && item.categoryName !== currentCat) { currentCat = item.categoryName; const h = document.createElement('h5'); h.className = 'codex-category-header text-xs uppercase text-[var(--color-text-secondary)] font-semibold mt-4 mb-2 px-0'; h.textContent = currentCat; itemsContainer.appendChild(h); } const btn = document.createElement('button'); btn.className = 'codex-item-button'; btn.textContent = item.name; btn.dataset.key = item.id; btn.dataset.type = item.type; if (item.id === selectedCodexItemKey) btn.classList.add('active'); btn.addEventListener('click', () => { selectedCodexItemKey = item.id; displayCodexDetail(item.type, item.id); itemsContainer.querySelectorAll('.codex-item-button').forEach(b => b.classList.remove('active')); btn.classList.add('active'); }); itemsContainer.appendChild(btn); }); } else { pageItems.forEach(item => { const btn = document.createElement('button'); btn.className = 'codex-item-button'; btn.textContent = item.name; btn.dataset.key = item.id; btn.dataset.type = item.type; if (item.id === selectedCodexItemKey) btn.classList.add('active'); btn.addEventListener('click', () => { selectedCodexItemKey = item.id; displayCodexDetail(item.type, item.id); itemsContainer.querySelectorAll('.codex-item-button').forEach(b => b.classList.remove('active')); btn.classList.add('active'); }); itemsContainer.appendChild(btn); }); } }
    function renderCodexListPaginationControls() { const paginationContainer = document.getElementById('codex-list-pagination'); if (!paginationContainer) return; paginationContainer.innerHTML = ''; const totalItems = currentFilteredCodexItems.length; const totalPages = Math.ceil(totalItems / CODEX_ITEMS_PER_PAGE); if (totalPages <= 1) return; const pBtn = document.createElement('button'); pBtn.innerHTML = '<i class="fa-duotone fa-arrow-left fa-fw mr-1" aria-hidden="true"></i><span class="hidden sm:inline">Prev</span>'; pBtn.disabled = (codexCurrentPage === 1); pBtn.addEventListener('click', () => { if (codexCurrentPage > 1) { codexCurrentPage--; renderCodexListPageItems(); renderCodexListPaginationControls(); } }); paginationContainer.appendChild(pBtn); const pInfo = document.createElement('span'); pInfo.className = 'p-2 text-xs whitespace-nowrap text-[var(--color-text-secondary)]'; pInfo.textContent = `Page ${codexCurrentPage} of ${totalPages}`; paginationContainer.appendChild(pInfo); const nBtn = document.createElement('button'); nBtn.innerHTML = '<span class="hidden sm:inline">Next</span><i class="fa-duotone fa-arrow-right fa-fw ml-1" aria-hidden="true"></i>'; nBtn.disabled = (codexCurrentPage === totalPages); nBtn.addEventListener('click', () => { if (codexCurrentPage < totalPages) { codexCurrentPage++; renderCodexListPageItems(); renderCodexListPaginationControls(); } }); paginationContainer.appendChild(nBtn); }
    function displayCodexDetail(itemType, itemKey) { const detailPane = document.getElementById('codex-detail-pane'); if (!detailPane) return; let itemData; if (itemType === 'character') { const [cat, lName, cKey] = itemKey.split('-'); itemData = charactersData[cat]?.[lName]?.[cKey]; } else if (itemType === 'location') { itemData = locationsData[itemKey]; } if (itemData) { let imgHTML = ''; if (itemData.imageUrl && itemData.imageUrl.trim() !== '') imgHTML = `<img src="${itemData.imageUrl}" alt="${itemData.name}" class="float-left mr-4 mb-2 w-24 h-24 sm:w-32 sm:h-32 object-cover rounded border border-[var(--color-border)]">`; let detHTML = ''; if (itemType === "character") { let nickHTML = ''; if(itemData.nickname && itemData.nickname.trim() !== '' && (!itemData.name || itemData.nickname.toLowerCase() !== itemData.name.split(' ')[0].toLowerCase())) nickHTML = `<p class="text-sm italic text-[var(--color-text-secondary)] mb-1">Known as: ${itemData.nickname}</p>`; let disHTML = ''; if (itemData.disabilities && Array.isArray(itemData.disabilities) && itemData.disabilities.length > 0) { const actDis = itemData.disabilities.filter(d => d && String(d).trim().toLowerCase() !== 'none'); if (actDis.length > 0) { disHTML = `<p class="disability-info font-semibold mt-2">Key Challenges:</p><ul class="list-disc list-inside">`; actDis.forEach(d => { disHTML += `<li>${d}</li>`; }); disHTML += `</ul>`; } } detHTML = `<h4>${itemData.name} ${itemData.age ? `(Age: ${itemData.age})` : ''}</h4> ${nickHTML} <p class="text-sm italic text-[var(--color-text-secondary)] mb-2">${itemData.family || ''}</p> <p>${itemData.description}</p> ${disHTML}`; } else if (itemType === "location") { detHTML = `<h4>${itemData.name} ${itemData.type ? `(${itemData.type})` : ''}</h4> <p>${itemData.description}</p>`; } detailPane.innerHTML = `${imgHTML}<div class="overflow-hidden">${detHTML}</div><div style="clear:both;"></div>`; } else { detailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Details not found.</p>`;}}

    async function initializeApp() {
        console.log("initializeApp: Starting...");
        assignGlobalDomElements();
        if (!libraryGridElement) {
            console.error("initializeApp: CRITICAL - libraryGridElement NOT FOUND. Halting.");
            document.body.innerHTML = `<p style="color:red; padding:20px; font-size:1.2em; text-align:center;">App Error: #library-grid missing. Check HTML ID.</p>`;
            return; 
        }
        checkDarkMode();
        const libraryLoadedSuccess = await loadLibraryManifest(); 
        if (libraryLoadedSuccess) {
            if(menuToggle) menuToggle.addEventListener('click', (e) => { e.stopPropagation(); toggleSidebar(); });
            if(overlay) overlay.addEventListener('click', () => { toggleSidebar(false); });
            if(sidebarCloseButton) sidebarCloseButton.addEventListener('click', () => { toggleSidebar(false); });
            if(backToLibraryButton) { backToLibraryButton.addEventListener('click', () => { window.location.hash = ''; showLibraryView(); if (mainAppTitleElement && libraryData.applicationTitle) { mainAppTitleElement.textContent = libraryData.applicationTitle; document.title = libraryData.applicationTitle; } if(tableOfContentsElement) tableOfContentsElement.innerHTML = ''; currentSeriesId = null; masterBookData = {}; charactersData = {}; locationsData = {}; flatChapterOrder = []; currentGlobalChapterIndex = 0; });}
            if(codexToggle) codexToggle.addEventListener('click', (e) => { if (!currentSeriesId) { alert("Please select a story series first."); return; } e.stopPropagation(); toggleCodexModal(true); });
            if(codexCloseButton) codexCloseButton.addEventListener('click', () => toggleCodexModal(false));
            if(codexModal) codexModal.addEventListener('click', (e) => { if (e.target.id === 'codex-modal') toggleCodexModal(false); });
            const searchInputForListener = document.getElementById('codex-search-input');
            if(searchInputForListener) { codexSearchInput = searchInputForListener; codexSearchInput.addEventListener('input', () => { codexCurrentPage = 1; selectedCodexItemKey = null; if(codexDetailPane) codexDetailPane.innerHTML = `<p>Select item...</p>`; updateFullCodexView(); }); }
            else {console.warn("Codex search input not found in initializeApp for listener.");}
            if(codexTabButtons) codexTabButtons.forEach(button => { button.addEventListener('click', (e) => { e.stopPropagation(); codexTabButtons.forEach(btn => btn.classList.remove('active')); button.classList.add('active'); currentCodexTab = button.dataset.tab; selectedCodexItemKey = null; codexCurrentPage = 1; const sInput = document.getElementById('codex-search-input'); if(sInput) { sInput.value = ''; sInput.placeholder = `Search ${currentCodexTab}...`; codexSearchInput = sInput;} updateFullCodexView(); if(codexDetailPane) codexDetailPane.innerHTML = `<p>Select item...</p>`; }); });
            if(prevButton) prevButton.addEventListener('click', () => navigateChapter(-1));
            if(nextButton) nextButton.addEventListener('click', () => navigateChapter(1));
            window.addEventListener('hashchange', () => handleHashChange(false));
            if (window.location.hash && !currentSeriesId && libraryViewElement && !libraryViewElement.classList.contains('hidden')) {
                console.log("Initial hash detected, but no series loaded yet.");
            } else if (window.location.hash && currentSeriesId) {
                handleHashChange(true); 
            }
            document.addEventListener('click', (e) => { if (e.target.closest('#menu-toggle') || e.target.closest('#sidebar') || e.target.closest('#codex-toggle') || e.target.closest('#codex-modal') || e.target.classList.contains('codex-item-button') || e.target.closest('#codex-list-pagination button') ) { return; } });
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', checkDarkMode);
        } else { console.error("initializeApp: Library manifest failed to load."); }
    }
    
    initializeApp();
});