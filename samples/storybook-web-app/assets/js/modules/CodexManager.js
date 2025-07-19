// assets/js/modules/CodexManager.js

export class CodexManager {
    constructor(domElements, uiManager) { 
        this.dom = domElements; 
        this.uiManager = uiManager; 

        this.charactersData = {};
        this.locationsData = {};
        this.currentSeriesId = null; 
        
        this.currentTab = 'characters'; 
        this.selectedItemKey = null;
        this.currentPage = 1;
        this.itemsPerPage = 10; 
        this.currentFilteredItems = [];

        console.log("CodexManager: Initialized.");
        this.#attachStaticListeners(); 
    }

    #attachStaticListeners() {
        if (this.dom.codexSearchInput) {
            this.dom.codexSearchInput.addEventListener('input', () => {
                console.log("CodexManager: Search input changed.");
                this.currentPage = 1;
                this.selectedItemKey = null; 
                if (this.dom.codexDetailPane) this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item from the list to view details.</p>`;
                this.updateFullView();
            });
        } else {
            console.warn("CodexManager constructor: codexSearchInput not found for listener attachment.");
        }

        if (this.dom.codexTabButtons) {
            this.dom.codexTabButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.handleTabClick(button.dataset.tab);
                });
            });
        } else {
            console.warn("CodexManager constructor: codexTabButtons not found for listener attachment.");
        }
    }

    setCodexData(seriesId, charactersData, locationsData) {
        this.currentSeriesId = seriesId; 
        this.charactersData = charactersData || {};
        this.locationsData = locationsData || {};
        console.log(`CodexManager.setCodexData: Received for seriesId "${this.currentSeriesId}".`);
        console.log(`CodexManager.setCodexData: Internal charactersData keys:`, Object.keys(this.charactersData));
        console.log(`CodexManager.setCodexData: Internal locationsData keys:`, Object.keys(this.locationsData));
        
        if (this.dom.codexModal && !this.dom.codexModal.classList.contains('hidden')) {
            this.currentTab = 'characters'; 
            if(this.dom.codexTabButtons) {
                this.dom.codexTabButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.tab === this.currentTab));
            }
            if(this.dom.codexSearchInput) {
                 this.dom.codexSearchInput.value = '';
                 this.dom.codexSearchInput.placeholder = `Search ${this.currentTab}...`;
            }
            this.updateFullView();
             if (this.dom.codexDetailPane) this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item from the list.</p>`;
        }
    }
    
    resetCodexData() {
        this.charactersData = {}; this.locationsData = {}; this.currentSeriesId = null; 
        this.currentTab = 'characters'; this.selectedItemKey = null; this.currentPage = 1;
        this.currentFilteredItems = [];
        if(this.dom.codexSearchInput) this.dom.codexSearchInput.value = '';
        if(this.dom.codexItemsContainer) this.dom.codexItemsContainer.innerHTML = '';
        if(this.dom.codexPaginationContainer) this.dom.codexPaginationContainer.innerHTML = '';
        if(this.dom.codexDetailPane) this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item.</p>`;
        console.log("CodexManager: Data reset.");
    }

    prepareAndShow() {
        console.log("CodexManager.prepareAndShow: Preparing to show Codex.");
        if (!this.dom.codexModal || !this.dom.codexTabButtons || !this.dom.codexSearchInput || !this.dom.codexItemsContainer || !this.dom.codexPaginationContainer || !this.dom.codexDetailPane) {
            console.error("CodexManager.prepareAndShow: One or more essential Codex DOM elements are missing.");
            return;
        }
        this.dom.codexTabButtons.forEach(btn => {
            btn.classList.toggle('active', btn.dataset.tab === this.currentTab);
        });
        if(this.dom.codexSearchInput) this.dom.codexSearchInput.placeholder = `Search ${this.currentTab}...`;
        
        this.updateFullView(); 
        if (this.dom.codexDetailPane) { 
            if (!this.selectedItemKey) {
                this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item from the list to view details.</p>`;
            }
        }
        console.log("CodexManager.prepareAndShow: Codex view prepared.");
    }

    handleTabClick(tabName) {
        if (!tabName || this.currentTab === tabName) return;
        console.log(`CodexManager.handleTabClick: Tab switched to ${tabName}`);
        
        this.currentTab = tabName;
        this.selectedItemKey = null;
        this.currentPage = 1;
        if (this.dom.codexSearchInput) {
            this.dom.codexSearchInput.value = '';
            this.dom.codexSearchInput.placeholder = `Search ${this.currentTab}...`;
        }
        if (this.dom.codexDetailPane) {
            this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Select an item from the list to view details.</p>`;
        }
        if (this.dom.codexTabButtons) {
            this.dom.codexTabButtons.forEach(btn => {
                btn.classList.toggle('active', btn.dataset.tab === this.currentTab);
            });
        }
        this.updateFullView();
        if (this.uiManager && this.uiManager.isCodexMobileView()) {
            this.uiManager.showCodexListView();
        }
    }

    getAllItemsForCurrentTab() {
        let allItems = [];
        console.log(`CodexManager.getAllItemsForCurrentTab: Getting items for tab "${this.currentTab}"`);
        if (this.currentTab === 'characters') {
            if (this.charactersData && typeof this.charactersData === 'object') {
                Object.keys(this.charactersData).forEach(category => { 
                    // console.log("Codex Processing Category:", category); 
                    if (this.charactersData[category] && typeof this.charactersData[category] === 'object') {
                        Object.keys(this.charactersData[category]).forEach(lastName => { 
                            //  console.log("Codex Processing LastName:", lastName);
                            if (this.charactersData[category][lastName] && typeof this.charactersData[category][lastName] === 'object') {
                                Object.keys(this.charactersData[category][lastName]).forEach(charKey => { 
                                    const item = this.charactersData[category][lastName][charKey];
                                    if(item && item.name){ 
                                        allItems.push({ ...item, id: `${category}-${lastName}-${charKey}`, type: 'character',categoryName: category.charAt(0).toUpperCase() + category.slice(1), subCategoryName: lastName }); 
                                        // console.log("Added character:", item.name);
                                    } else {
                                        // console.warn("Skipping invalid character item:", category, lastName, charKey, item);
                                    }
                                });
                            }
                        });
                    }
                });
            } else {
                 console.warn("getAllItemsForCurrentTab: this.charactersData is null or not an object");
            }
        } else if (this.currentTab === 'locations') {
            if (this.locationsData && typeof this.locationsData === 'object') {
                Object.keys(this.locationsData).forEach(key => {
                    const item = this.locationsData[key];
                     if(item && item.name){ allItems.push({ ...item, id: key, type: 'location' }); } 
                });
            } else {
                 console.warn("getAllItemsForCurrentTab: this.locationsData is null or not an object");
            }
        }
        console.log(`CodexManager.getAllItemsForCurrentTab ('${this.currentTab}'): Found ${allItems.length} total items before sort.`);
        return allItems.sort((a, b) => { 
            if (a.categoryName && b.categoryName && a.categoryName !== b.categoryName) {
                return a.categoryName.localeCompare(b.categoryName); 
            }
            return a.name.localeCompare(b.name); 
        });
    }

    updateFullView() { 
        if (!this.dom.codexItemsContainer || !this.dom.codexPaginationContainer || !this.dom.codexSearchInput) { 
            console.warn("CodexManager.updateFullView: Missing critical DOM elements for Codex list/pagination/search.");
            return; 
        }
        const searchTerm = this.dom.codexSearchInput.value.toLowerCase(); 
        const allItemsForTab = this.getAllItemsForCurrentTab();
        this.currentFilteredItems = allItemsForTab.filter(item => {
            if (!item || !item.name) return false; 
            const nameMatch = item.name.toLowerCase().includes(searchTerm);
            const categoryMatch = this.currentTab === 'characters' && item.categoryName ? item.categoryName.toLowerCase().includes(searchTerm) : false;
            const subCategoryMatch = this.currentTab === 'characters' && item.subCategoryName ? item.subCategoryName.toLowerCase().includes(searchTerm) : false;
            const typeMatch = this.currentTab === 'locations' && item.type ? item.type.toLowerCase().includes(searchTerm) : false;
            return nameMatch || categoryMatch || subCategoryMatch || typeMatch;
        });
        console.log(`CodexManager.updateFullView: Filtered to ${this.currentFilteredItems.length} items for tab "${this.currentTab}" with search term "${searchTerm}".`);
        this.renderListPageItems(); 
        this.renderListPaginationControls();
    }

    renderListPageItems() {
        if (!this.dom.codexItemsContainer) {
            console.error("CodexManager.renderListPageItems: codexItemsContainer is NULL.");
            return;
        } 
        this.dom.codexItemsContainer.innerHTML = ''; 
        this.dom.codexItemsContainer.scrollTop = 0;
        const startIndex = (this.currentPage - 1) * this.itemsPerPage; 
        const endIndex = startIndex + this.itemsPerPage;
        const pageItems = this.currentFilteredItems.slice(startIndex, endIndex);
        console.log(`CodexManager.renderListPageItems: Rendering ${pageItems.length} items for page ${this.currentPage}.`);

        if (pageItems.length === 0) { 
            if (this.dom.codexSearchInput && this.dom.codexSearchInput.value) { 
                this.dom.codexItemsContainer.innerHTML = `<p class="p-3 text-sm text-[var(--color-text-secondary)]">No results for "${this.dom.codexSearchInput.value}".</p>`; 
            } else { 
                this.dom.codexItemsContainer.innerHTML = `<p class="p-3 text-sm text-[var(--color-text-secondary)]">No items in this category.</p>`; 
            } 
            return; 
        }

        if (this.currentTab === 'characters') {
            let currentDisplayCategory = null; 
            pageItems.forEach(item => {
                if (item.categoryName && item.categoryName !== currentDisplayCategory) {
                    currentDisplayCategory = item.categoryName; 
                    const categoryHeader = document.createElement('h5');
                    categoryHeader.className = 'codex-category-header text-xs uppercase text-[var(--color-text-secondary)] font-semibold mt-4 mb-2 px-0'; 
                    categoryHeader.textContent = currentDisplayCategory;
                    this.dom.codexItemsContainer.appendChild(categoryHeader);
                }
                const button = document.createElement('button'); 
                button.className = 'codex-item-button'; 
                button.textContent = item.name; 
                button.dataset.key = item.id; 
                button.dataset.type = item.type; 
                if (item.id === this.selectedItemKey) button.classList.add('active');
                button.addEventListener('click', () => { 
                    this.selectedItemKey = item.id; 
                    this.displayDetail(item.type, item.id); 
                    this.dom.codexItemsContainer.querySelectorAll('.codex-item-button').forEach(b => b.classList.remove('active')); 
                    button.classList.add('active'); 
                });
                this.dom.codexItemsContainer.appendChild(button);
            });
        } else { // For locations or other flat lists
            pageItems.forEach(item => {
                const button = document.createElement('button'); 
                button.className = 'codex-item-button'; 
                button.textContent = item.name; 
                button.dataset.key = item.id; 
                button.dataset.type = item.type; 
                if (item.id === this.selectedItemKey) button.classList.add('active');
                button.addEventListener('click', () => { 
                    this.selectedItemKey = item.id; 
                    this.displayDetail(item.type, item.id); 
                    this.dom.codexItemsContainer.querySelectorAll('.codex-item-button').forEach(b => b.classList.remove('active')); 
                    button.classList.add('active'); 
                });
                this.dom.codexItemsContainer.appendChild(button);
            });
        }
    }

    renderListPaginationControls() { 
        if (!this.dom.codexPaginationContainer) return; 
        this.dom.codexPaginationContainer.innerHTML = ''; 
        const totalItems = this.currentFilteredItems.length; 
        const totalPages = Math.ceil(totalItems / this.itemsPerPage); 
        if (totalPages <= 1) return;
        
        const prevPageBtn = document.createElement('button'); 
        prevPageBtn.innerHTML = '<i class="fa-duotone fa-arrow-left fa-fw mr-1" aria-hidden="true"></i><span class="hidden sm:inline">Prev</span>'; 
        prevPageBtn.disabled = (this.currentPage === 1); 
        prevPageBtn.addEventListener('click', () => { 
            if (this.currentPage > 1) { 
                this.currentPage--; 
                this.renderListPageItems(); 
                this.renderListPaginationControls(); 
            } 
        }); 
        this.dom.codexPaginationContainer.appendChild(prevPageBtn);
        
        const pageInfo = document.createElement('span'); 
        pageInfo.className = 'p-2 text-xs whitespace-nowrap text-[var(--color-text-secondary)]'; 
        pageInfo.textContent = `Page ${this.currentPage} of ${totalPages}`; 
        this.dom.codexPaginationContainer.appendChild(pageInfo);
        
        const nextPageBtn = document.createElement('button'); 
        nextPageBtn.innerHTML = '<span class="hidden sm:inline">Next</span><i class="fa-duotone fa-arrow-right fa-fw ml-1" aria-hidden="true"></i>'; 
        nextPageBtn.disabled = (this.currentPage === totalPages); 
        nextPageBtn.addEventListener('click', () => { 
            if (this.currentPage < totalPages) { 
                this.currentPage++; 
                this.renderListPageItems(); 
                this.renderListPaginationControls(); 
            } 
        }); 
        this.dom.codexPaginationContainer.appendChild(nextPageBtn);
    }

    displayDetail(itemType, itemKey) { 
        if (!this.dom.codexDetailPane) return; 
        if (!this.currentSeriesId) {
             this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Error: Series context lost.</p>`;
            return;
        }
        let itemData; 
        const seriesImageBasePath = `books/${this.currentSeriesId}/`; 

        if (itemType === 'character') { 
            const [cat, lName, cKey] = itemKey.split('-'); 
            itemData = this.charactersData[cat]?.[lName]?.[cKey]; 
        } else if (itemType === 'location') { 
            itemData = this.locationsData[itemKey]; 
        } 
        
        if (itemData) { 
            let imgHTML = ''; 
            if (itemData.imageUrl && itemData.imageUrl.trim() !== '') {
                const fullImagePath = `${seriesImageBasePath}${itemData.imageUrl}`;
                imgHTML = `<img src="${fullImagePath}" alt="${itemData.name}" class="float-left mr-4 mb-2 w-24 h-24 sm:w-32 sm:h-32 object-cover rounded border border-[var(--color-border)]">`;
            }
            let detHTML = ''; 
            if (itemType === "character") { 
                let nickHTML = ''; 
                if(itemData.nickname && itemData.nickname.trim() !== '' && (!itemData.name || itemData.nickname.toLowerCase() !== itemData.name.split(' ')[0].toLowerCase())) {
                    nickHTML = `<p class="text-sm italic text-[var(--color-text-secondary)] mb-1">Known as: ${itemData.nickname}</p>`;
                }
                let disHTML = ''; 
                if (itemData.disabilities && Array.isArray(itemData.disabilities) && itemData.disabilities.length > 0) { 
                    const actDis = itemData.disabilities.filter(d => d && String(d).trim().toLowerCase() !== 'none'); 
                    if (actDis.length > 0) { 
                        disHTML = `<p class="disability-info font-semibold mt-2">Key Challenges:</p><ul class="list-disc list-inside">`; 
                        actDis.forEach(d => { disHTML += `<li>${d}</li>`; }); 
                        disHTML += `</ul>`; 
                    } 
                } 
                detHTML = `<h4>${itemData.name} ${itemData.age ? `(Age: ${itemData.age})` : ''}</h4> ${nickHTML} <p class="text-sm italic text-[var(--color-text-secondary)] mb-2">${itemData.family || ''}</p> <p>${itemData.description}</p> ${disHTML}`; 
            } else if (itemType === "location") { 
                detHTML = `<h4>${itemData.name} ${itemData.type ? `(${itemData.type})` : ''}</h4> <p>${itemData.description}</p>`; 
            } 
            this.dom.codexDetailPane.innerHTML = `${imgHTML}<div class="overflow-hidden">${detHTML}</div><div style="clear:both;"></div>`; 
            
            if (this.uiManager && this.uiManager.isCodexMobileView()) {
                this.uiManager.showCodexDetailViewMobile(itemData.name);
            }
        } else { 
            this.dom.codexDetailPane.innerHTML = `<p class="text-[var(--color-text-secondary)]">Details not found.</p>`;
        }
    }
}