function checkElement(id, attemptName) {
    const el = document.getElementById(id);
    if (el) {
        console.log(`SUCCESS (${attemptName}): Element with ID '${id}' FOUND!`, el);
        el.innerHTML = `<p style="color: green; border: 2px solid green; padding: 10px;">Element '${id}' successfully found by ${attemptName}!</p>`;
        el.style.border = "5px solid limegreen"; // Make it super obvious
        return true;
    } else {
        console.error(`FAILURE (${attemptName}): Element with ID '${id}' NOT FOUND.`);
        return false;
    }
}

// Test 1: Immediately when script runs (due to defer, DOM should be mostly parsed)
console.log("Test 1: Running immediately after script parse (due to defer).");
checkElement('library-grid', 'Immediate Defer Test');

// Test 2: Inside DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    console.log("Test 2: DOMContentLoaded event fired.");
    checkElement('library-grid', 'DOMContentLoaded Test');

    // Test 3: With a slight delay after DOMContentLoaded
    setTimeout(() => {
        console.log("Test 3: Running 100ms after DOMContentLoaded.");
        checkElement('library-grid', 'DOMContentLoaded + 100ms Timeout Test');
    }, 100);

    // Test 4: With a longer delay
    setTimeout(() => {
        console.log("Test 4: Running 1 second after DOMContentLoaded.");
        checkElement('library-grid', 'DOMContentLoaded + 1s Timeout Test');
    }, 1000);
});

// Test 5: window.onload (after all resources like images are loaded)
window.onload = () => {
    console.log("Test 5: window.onload event fired.");
    checkElement('library-grid', 'window.onload Test');
};

console.log("End of minimal test script execution.");