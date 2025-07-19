// assets/js/modules/DataService.js

export class DataService {
    constructor() {
        this.libraryData = null; // Cache for library data
        // console.log("DataService: Initialized.");
    }

    async #fetchJSON(url) {
        // ... (existing private helper method)
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status} for ${url}`);
            }
            return await response.json();
        } catch (error) {
            console.error(`DataService: Error fetching JSON from ${url}:`, error);
            throw error; 
        }
    }

    async #fetchText(url) {
        // ... (existing private helper method)
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status} for ${url}`);
            }
            return await response.text();
        } catch (error) {
            console.error(`DataService: Error fetching text from ${url}:`, error);
            throw error; 
        }
    }

    async loadLibraryManifest() {
        console.log("DataService: Fetching library.json...");
        // Store the fetched data in the instance property before returning
        this.libraryData = await this.#fetchJSON('assets/json/library.json');
        return this.libraryData;
    }

    // --- NEW METHOD TO ADD ---
    getCachedLibraryData() {
        if (!this.libraryData) {
            console.warn("DataService.getCachedLibraryData: libraryData has not been loaded yet or failed to load.");
        }
        return this.libraryData; // Returns the cached library data (or null if not loaded)
    }
    // --- END NEW METHOD ---


    async loadSeriesBookData(seriesId) {
        if (!seriesId) {
            return Promise.reject(new Error("Series ID is required for book data."));
        }
        const path = `books/${seriesId}/book.json`;
        return this.#fetchJSON(path);
    }

    async loadSeriesCharactersData(seriesId) {
        if (!seriesId) {
            return Promise.reject(new Error("Series ID is required for characters data."));
        }
        const path = `books/${seriesId}/characters.json`;
        return this.#fetchJSON(path);
    }

    async loadSeriesLocationsData(seriesId) {
        if (!seriesId) {
            return Promise.reject(new Error("Series ID is required for locations data."));
        }
        const path = `books/${seriesId}/locations.json`;
        return this.#fetchJSON(path);
    }

    async fetchChapterContent(filePath) {
        if (!filePath) {
            return Promise.reject(new Error("File path is required for chapter content."));
        }
        return this.#fetchText(filePath);
    }
}