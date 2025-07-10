// your-theme-name/assets/js/pattern-padding-remover.js

document.addEventListener('DOMContentLoaded', function() {
    // Select the specific div that starts your pattern
    const patternInnerBlock = document.querySelector('.wp-block-group.section.bg-color-op-1');

    // Check if the pattern's inner block exists on the page
    if (patternInnerBlock) {
        // Find the closest parent <section> element
        const wrappingSection = patternInnerBlock.closest('section');

        // If a wrapping section is found, add a unique class to it
        if (wrappingSection) {
            wrappingSection.classList.add('pattern-wrapper-no-padding');
        }
    }
});