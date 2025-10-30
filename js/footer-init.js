/**
 * Centralized Footer Initialization Script
 * This script handles consistent footer loading across all pages
 */

// Fix footer paths based on current page location
function fixFooterPaths() {
    // Get the base path and determine relative location
    const basePath = getBasePath();
    const currentPath = window.location.pathname;
    const relativePath = basePath ? currentPath.replace(basePath, '') : currentPath;
    const pathParts = relativePath.split('/').filter(p => p);
    
    // Check if we're in a page-level subdirectory
    let isInPageSubdirectory = false;
    if (pathParts.length > 1) {
        const secondLastPart = pathParts[pathParts.length - 2];
        if (secondLastPart && !secondLastPart.includes('.')) {
            isInPageSubdirectory = true;
        }
    }
    
    // Fix footer links (footer.html uses root-relative paths)
    const footerLinks = document.querySelectorAll('.footer-link');
    footerLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.includes('.html') && !href.startsWith('http') && !href.startsWith('#')) {
            // For page subdirectories, add '../' to root-relative paths
            if (isInPageSubdirectory && !href.startsWith('../')) {
                link.href = '../' + href;
            }
            // For root directory, paths are already correct
        }
    });
}

// Main footer initialization function
function initializeFooter() {
    // Fix all footer paths based on current location
    fixFooterPaths();
}

// Detect the base path of the application
function getBasePath() {
    const scripts = document.getElementsByTagName('script');
    for (let script of scripts) {
        const src = script.src;
        if (src.includes('footer-init.js')) {
            // Extract the base path from the script src
            const url = new URL(src);
            const path = url.pathname;
            // Remove "/js/footer-init.js" from the end
            const basePath = path.replace(/\/js\/footer-init\.js$/, '');
            return basePath || '';
        }
    }
    return '';
}

// Load footer component and initialize it
function loadFooter() {
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (!footerPlaceholder) {
        console.error('Footer placeholder not found');
        return;
    }
    
    // Get the base path of the application
    const basePath = getBasePath();
    const currentPath = window.location.pathname;
    
    // Determine if we're in a subdirectory within the app
    // Remove basePath from currentPath to get relative location
    const relativePath = basePath ? currentPath.replace(basePath, '') : currentPath;
    const pathParts = relativePath.split('/').filter(p => p);
    
    // Check if we're in a page-level subdirectory (like /pages/, /admin/)
    let needsParentDir = false;
    if (pathParts.length > 1) {
        const secondLastPart = pathParts[pathParts.length - 2];
        // If we're inside a subdirectory like 'pages', 'admin', etc.
        if (secondLastPart && !secondLastPart.includes('.')) {
            needsParentDir = true;
        }
    }
    
    const footerPath = needsParentDir ? '../components/footer.html' : 'components/footer.html';
    
    console.log('Base path:', basePath);
    console.log('Current path:', currentPath);
    console.log('Relative path:', relativePath);
    console.log('Loading footer from:', footerPath);
    
    fetch(footerPath)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            footerPlaceholder.innerHTML = data;
            // Initialize footer after it's loaded
            initializeFooter();
        })
        .catch(error => {
            console.error('Error loading footer:', error);
            console.error('Footer path attempted:', footerPath);
        });
}

// Auto-load footer when DOM is ready or immediately if already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadFooter);
} else {
    // DOM already loaded, execute immediately
    loadFooter();
}
