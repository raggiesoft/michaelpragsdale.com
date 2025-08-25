// assets/js/modules/HudManager.js

export class HudManager {
    constructor(hudDisplayElement, sceneTextElementForObserver) { // sceneTextElement needed for observer root
        this.hudStatusDisplayElement = hudDisplayElement;
        this.sceneTextElement = sceneTextElementForObserver; // Store for IntersectionObserver
        this.currentHudStatus = {};
        this.chapterInitialHudStatus = null;
        this.hudIntersectionObserver = null;
        this.lastActivatedHudTrigger = null;

        if (this.hudStatusDisplayElement) {
            this.hudTitleElement = this.hudStatusDisplayElement.querySelector('h4');
            this.hudStatsContainerElement = this.hudStatusDisplayElement.querySelector('#hud-stats-container');
            this.hudAlertTextElement = this.hudStatusDisplayElement.querySelector('#hud-alert-text');

            if (!this.hudTitleElement) console.warn("HudManager: HUD H4 title element not found.");
            if (!this.hudStatsContainerElement) console.warn("HudManager: HUD stats container element not found.");
            if (!this.hudAlertTextElement) console.warn("HudManager: HUD alert text element not found.");
        } else {
            console.error("HudManager: Main HUD display element not provided or not found.");
        }
        // console.log("HudManager: Initialized.");
    }

    setChapterInitialHudStatus(initialStatus) {
        this.chapterInitialHudStatus = initialStatus || null;
        // console.log("HudManager: Chapter initial HUD status set:", this.chapterInitialHudStatus);
    }

    getChapterInitialHudStatus() {
        return this.chapterInitialHudStatus;
    }

    updateHudDisplay(statusData) {
        if (!this.hudStatusDisplayElement) return;
        if (!statusData || Object.keys(statusData).length === 0) {
            this.hudStatusDisplayElement.classList.add('hidden');
            this.currentHudStatus = {}; return;
        }
        
        // Merge new status. If a key is in statusData, it overrides.
        // If a key was in currentHudStatus but not in new statusData, it persists from current.
        // To explicitly clear a field (like alertText), the incoming statusData must provide it as "" or null.
        this.currentHudStatus = { ...this.currentHudStatus, ...statusData };
        
        this.hudStatusDisplayElement.classList.remove('hidden');
        
        let statsContainer = this.hudStatsContainerElement;
        if (!statsContainer && this.hudStatusDisplayElement) { // Attempt to re-query if not found initially
            statsContainer = this.hudStatusDisplayElement.querySelector('#hud-stats-container');
            if (!statsContainer) { // If still not found, create it
                const titleElement = this.hudStatusDisplayElement.querySelector('h4');
                statsContainer = document.createElement('div'); statsContainer.id = 'hud-stats-container';
                if (titleElement && titleElement.nextSibling) this.hudStatusDisplayElement.insertBefore(statsContainer, titleElement.nextSibling);
                else if (titleElement) this.hudStatusDisplayElement.appendChild(statsContainer);
                else this.hudStatusDisplayElement.prepend(statsContainer);
                this.hudStatsContainerElement = statsContainer; // Update the stored reference
            }
        }
        if(statsContainer) statsContainer.innerHTML = ''; 
        
        const hudType = this.currentHudStatus.type || "System"; 
        if(this.hudTitleElement) {
            this.hudTitleElement.textContent = `${hudType.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())} Status:`;
        }

        if (statsContainer) {
            for (const key in this.currentHudStatus) {
                if (this.currentHudStatus.hasOwnProperty(key) && key !== 'type' && key !== 'alertText') {
                    const statDiv = document.createElement('div');
                    const label = key.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
                    statDiv.innerHTML = `${label}: <span class="font-medium">${this.currentHudStatus[key]}</span>`;
                    const valueSpan = statDiv.querySelector('span');
                    if(valueSpan){
                        const valueText = String(this.currentHudStatus[key]).toLowerCase();
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
        }
        
        if (this.hudAlertTextElement) {
            if (this.currentHudStatus.alertText && this.currentHudStatus.alertText.trim() !== "") {
                this.hudAlertTextElement.textContent = this.currentHudStatus.alertText;
                this.hudAlertTextElement.classList.remove('hidden');
            } else {
                this.hudAlertTextElement.textContent = ''; 
                this.hudAlertTextElement.classList.add('hidden'); 
            }
        }
    }

    preprocessMarkdownForHudTriggers(markdownContent) {
        const statusRegexGlobal = new RegExp("", "gi");
        const firstCommentRegex = new RegExp("^\\s*", "i");
        
        let firstStatusCommentData = null;

        const firstMatchResult = firstCommentRegex.exec(markdownContent);
        if (firstMatchResult && firstMatchResult[1] && typeof firstMatchResult[1] === 'string') {
            try {
                firstStatusCommentData = JSON.parse(firstMatchResult[1]);
            } catch (e) {
                console.error("HudManager.preprocess: Error parsing initial HUD JSON from first comment. JSON was:", firstMatchResult[1], "Error:", e);
                firstStatusCommentData = null; 
            }
        }

        const processedContent = markdownContent.replace(statusRegexGlobal, (fullMatch, capturedJsonString) => {
            if (typeof capturedJsonString === 'string' && capturedJsonString.trim().startsWith('{') && capturedJsonString.trim().endsWith('}')) {
                try {
                    JSON.parse(capturedJsonString); 
                    const escapedJsonString = capturedJsonString.replace(/'/g, "&apos;").replace(/"/g, "&quot;");
                    return `<span class="hud-trigger" data-status='${escapedJsonString}'></span>`;
                } catch (e) {
                    console.error("HudManager.preprocess: Error processing HUD JSON for trigger span. JSON was:", capturedJsonString, "Error:", e);
                    return ''; 
                }
            } else {
                console.warn("HudManager.preprocess: Matched HUD comment, but captured JSON group was not valid. Full match:", fullMatch);
                return ''; 
            }
        });
        return { processedContent: processedContent, initialStatusFromMarkdown: firstStatusCommentData };
    }

    setupHudIntersectionObserver() {
        if (this.hudIntersectionObserver) { this.hudIntersectionObserver.disconnect(); }
        this.lastActivatedHudTrigger = null; 
        if (!this.sceneTextElement) {
            console.warn("HudManager.setupHudIntersectionObserver: sceneTextElement not available.");
            return;
        }
        const triggers = this.sceneTextElement.querySelectorAll('.hud-trigger');
        if (triggers.length === 0) {
            this.updateHudDisplay(this.chapterInitialHudStatus || null); 
            return; 
        }
        
        const options = { root: this.sceneTextElement, rootMargin: "-48% 0px -48% 0px", threshold: 0.01 };
        this.hudIntersectionObserver = new IntersectionObserver((entries) => {
            let highestInView = null; let minTop = Infinity;
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.boundingClientRect.top < minTop) { minTop = entry.boundingClientRect.top; highestInView = entry.target; }
                }
            });
            if (!highestInView) {
                let mostRecentlyPassedTrigger = null; let maxBottom = -Infinity; 
                triggers.forEach(trigger => {
                    const rect = trigger.getBoundingClientRect(); const sceneRect = this.sceneTextElement.getBoundingClientRect();
                    if (rect.bottom < (sceneRect.top + sceneRect.height * 0.5) && rect.bottom > maxBottom) {
                        maxBottom = rect.bottom; mostRecentlyPassedTrigger = trigger;
                    }
                });
                highestInView = mostRecentlyPassedTrigger;
            }
            if (highestInView) {
                if (highestInView !== this.lastActivatedHudTrigger) {
                    try {
                        const statusJsonString = highestInView.dataset.status.replace(/&apos;/g, "'").replace(/&quot;/g, '"');
                        const status = JSON.parse(statusJsonString); this.updateHudDisplay(status);
                        this.lastActivatedHudTrigger = highestInView;
                    } catch (e) { console.error("Error parsing status JSON from trigger:", e); }
                }
            } else if (this.lastActivatedHudTrigger !== 'initial_status_applied' && this.chapterInitialHudStatus) {
                this.updateHudDisplay(this.chapterInitialHudStatus); this.lastActivatedHudTrigger = 'initial_status_applied'; 
            } else if (!this.chapterInitialHudStatus && !highestInView) {
                this.updateHudDisplay(null); this.lastActivatedHudTrigger = null;
            }
        }, options);
        triggers.forEach(trigger => this.hudIntersectionObserver.observe(trigger));
    }

    resetHud() {
        this.currentHudStatus = {};
        this.chapterInitialHudStatus = null;
        if (this.hudStatusDisplayElement) {
            this.hudStatusDisplayElement.classList.add('hidden');
            if (this.hudStatsContainerElement) this.hudStatsContainerElement.innerHTML = '';
            if (this.hudAlertTextElement) {
                this.hudAlertTextElement.innerHTML = '';
                this.hudAlertTextElement.classList.add('hidden');
            }
            if(this.hudTitleElement) this.hudTitleElement.textContent = "Status:";
        }
        if (this.hudIntersectionObserver) {
            this.hudIntersectionObserver.disconnect();
            this.hudIntersectionObserver = null;
        }
        this.lastActivatedHudTrigger = null;
        // console.log("HudManager: HUD reset.");
    }
}