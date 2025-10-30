/**
 * Centralized Header Initialization Script
 * This script handles consistent header loading across all pages
 */

// Check login status and update header
function checkLoginStatus() {
    const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true';
    const dashboardLink = document.getElementById('dashboard-link');
    const mobileDashboardLink = document.getElementById('mobile-dashboard-link');
    const loginBtn = document.getElementById('login-btn');
    const mobileLoginBtn = document.getElementById('mobile-login-btn');
    
	// Helper to resolve paths correctly whether we're in a subdirectory or root
	function resolvePath(pathFromRoot) {
		const pathParts = window.location.pathname.split('/').filter(p => p);
		const isInSubdirectory = pathParts.length > 1;
		return isInSubdirectory ? ('../' + pathFromRoot) : pathFromRoot;
	}

	// Centralized logout that calls API and redirects to home
	async function handleLogout(event) {
		if (event) event.preventDefault();
		try {
			await fetch(resolvePath('api/auth/logout.php'), {
				method: 'POST'
			});
		} catch (err) {
			// Swallow network errors to ensure UX continues
		} finally {
			localStorage.removeItem('isLoggedIn');
			localStorage.removeItem('userData');
			window.location.href = resolvePath('index.html');
		}
	}

	if (isLoggedIn) {
        // Show dashboard link
        if (dashboardLink) dashboardLink.style.display = 'inline-block';
        if (mobileDashboardLink) mobileDashboardLink.style.display = 'block';
        
        // Change login button to logout
		if (loginBtn) {
			loginBtn.textContent = 'logout';
			loginBtn.onclick = handleLogout;
		}
        
		if (mobileLoginBtn) {
			mobileLoginBtn.textContent = 'Logout';
			mobileLoginBtn.onclick = handleLogout;
		}
    } else {
        // Show login button - temporarily redirect to dashboard
        if (loginBtn) {
            loginBtn.textContent = 'log in';
            loginBtn.onclick = function(e) {
                e.preventDefault();
                // Set login status and redirect to dashboard
                const userData = {
                    name: 'John Doe',
                    email: 'john.doe@example.com'
                };
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userData', JSON.stringify(userData));
                // Determine correct dashboard path based on current location
                const dashboardPath = window.location.pathname.includes('/pages/') ? 'dashboard.html' : 'pages/dashboard.html';
                window.location.href = dashboardPath;
            };
        }
        
        if (mobileLoginBtn) {
            mobileLoginBtn.textContent = 'Log In';
            mobileLoginBtn.onclick = function(e) {
                e.preventDefault();
                // Set login status and redirect to dashboard
                const userData = {
                    name: 'John Doe',
                    email: 'john.doe@example.com'
                };
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userData', JSON.stringify(userData));
                // Determine correct dashboard path based on current location
                const dashboardPath = window.location.pathname.includes('/pages/') ? 'dashboard.html' : 'pages/dashboard.html';
                window.location.href = dashboardPath;
            };
        }
    }
}

// Mobile Menu Functionality
function initMobileMenu() {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    
    if (hamburgerMenu && mobileNav) {
        hamburgerMenu.addEventListener('click', function() {
            hamburgerMenu.classList.toggle('active');
            mobileNav.classList.toggle('active');
            
            if (mobileNav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // Close menu when clicking on links (but not dropdown toggles)
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Don't close menu if it's a dropdown toggle
                if (!this.classList.contains('mobile-dropdown-toggle')) {
                    hamburgerMenu.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    }
}

// Mobile Dropdown Functionality
function initMobileDropdowns() {
    // Products dropdown
    const mobileProductsToggle = document.getElementById('mobile-products-toggle');
    const mobileProductsContent = document.getElementById('mobile-products-content');
    
    if (mobileProductsToggle && mobileProductsContent) {
        mobileProductsToggle.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
            
            if (mobileProductsContent.classList.contains('show')) {
                mobileProductsContent.classList.remove('show');
            } else {
                mobileProductsContent.classList.add('show');
            }
        });
    }
    
    // Solutions dropdown
    const mobileDropdownToggle = document.getElementById('mobile-solutions-toggle');
    const mobileDropdownContent = document.getElementById('mobile-solutions-content');
    
    if (mobileDropdownToggle && mobileDropdownContent) {
        mobileDropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle active class
            this.classList.toggle('active');
            
            // Toggle dropdown content
            if (mobileDropdownContent.classList.contains('show')) {
                mobileDropdownContent.classList.remove('show');
            } else {
                mobileDropdownContent.classList.add('show');
            }
        });
        
        // Close dropdown when clicking on dropdown items
        const mobileDropdownItems = document.querySelectorAll('.mobile-dropdown-item');
        mobileDropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                // Close the mobile menu when navigating
                const hamburgerMenu = document.getElementById('hamburger-menu');
                const mobileNav = document.getElementById('mobile-nav');
                
                if (hamburgerMenu && mobileNav) {
                    hamburgerMenu.classList.remove('active');
                    mobileNav.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    }
}

// Fix header paths based on current page location
function fixHeaderPaths() {
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
    
    // Fix logo paths
    const logoDesktop = document.querySelector('.logo-desktop');
    const logoMobile = document.querySelector('.logo-mobile');
    const logoLink = document.querySelector('.logo-link');
    
    if (logoDesktop) {
        logoDesktop.src = isInPageSubdirectory ? '../brand/epc - desktop.png' : 'brand/epc - desktop.png';
    }
    
    if (logoMobile) {
        logoMobile.src = isInPageSubdirectory ? '../brand/epc - mobile.png' : 'brand/epc - mobile.png';
    }
    
    if (logoLink) {
        logoLink.href = isInPageSubdirectory ? '../index.html' : 'index.html';
    }
    
    // Fix navigation links (header.html now uses root-relative paths)
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.includes('.html') && !href.startsWith('http') && !href.startsWith('#')) {
            // For page subdirectories, add '../' to root-relative paths
            if (isInPageSubdirectory && !href.startsWith('../')) {
                link.href = '../' + href;
            }
            // For root directory, paths are already correct
        }
    });
    
    // Fix dropdown links (including mega menu items)
    const dropdownItems = document.querySelectorAll('.dropdown-item, .mega-menu-item, .view-all-link');
    dropdownItems.forEach(link => {
        const href = link.getAttribute('href');
        if (href && (href.includes('.html') || href.includes('.php')) && !href.startsWith('http') && !href.startsWith('#')) {
            // For page subdirectories, add '../' to root-relative paths
            if (isInPageSubdirectory && !href.startsWith('../')) {
                link.href = '../' + href;
            }
            // For root directory, paths are already correct
        }
    });
    
    // Fix mobile navigation links
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    mobileNavLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.includes('.html') && !href.startsWith('http') && !href.startsWith('#')) {
            // For page subdirectories, add '../' to root-relative paths
            if (isInPageSubdirectory && !href.startsWith('../')) {
                link.href = '../' + href;
            }
            // For root directory, paths are already correct
        }
    });
    
    // Fix mobile dropdown items
    const mobileDropdownItems = document.querySelectorAll('.mobile-dropdown-item');
    mobileDropdownItems.forEach(link => {
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

// Add scroll animation to header
function initHeaderScrollAnimation() {
    const header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
}

// Load dynamic mega menu from database
async function loadDynamicMegaMenu() {
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
    
    const apiPath = isInPageSubdirectory ? '../api/products/mega-menu.php' : 'api/products/mega-menu.php';
    
    try {
        const response = await fetch(apiPath);
        const data = await response.json();
        
        if (data.success) {
            // Update Large Format column
            const largeFormatColumn = document.querySelector('.mega-menu-column:first-child');
            if (largeFormatColumn && data.largeFormat.length > 0) {
                const productLinks = data.largeFormat.map(product => {
                    const href = isInPageSubdirectory ? `../pages/printing-services.html` : `pages/printing-services.html`;
                    return `<a href="${href}" class="mega-menu-item">${product.name}</a>`;
                }).join('');
                
                // Keep the title, replace just the links
                const title = largeFormatColumn.querySelector('.column-title');
                if (title) {
                    largeFormatColumn.innerHTML = '';
                    largeFormatColumn.appendChild(title);
                    largeFormatColumn.innerHTML += productLinks;
                }
            }
            
            // Update Small Format column
            const smallFormatColumn = document.querySelector('.mega-menu-column:last-child');
            if (smallFormatColumn && data.smallFormat.length > 0) {
                const productLinks = data.smallFormat.map(product => {
                    const href = isInPageSubdirectory ? `../pages/printing-services.html` : `pages/printing-services.html`;
                    return `<a href="${href}" class="mega-menu-item">${product.name}</a>`;
                }).join('');
                
                // Add "View More" link at the end
                const viewMoreHref = isInPageSubdirectory ? 'products.php?category=small-format' : 'pages/products.php?category=small-format';
                const viewMoreLink = `<a href="${viewMoreHref}" class="mega-menu-item">View More →</a>`;
                
                // Keep the title, replace the links
                const title = smallFormatColumn.querySelector('.column-title');
                if (title) {
                    smallFormatColumn.innerHTML = '';
                    smallFormatColumn.appendChild(title);
                    smallFormatColumn.innerHTML += productLinks + viewMoreLink;
                }
            }
        }
    } catch (error) {
        console.error('Error loading mega menu:', error);
        // Fallback: menu will use the static HTML
    }
}

// Main header initialization function
function initializeHeader() {
    // Fix all header paths based on current location
    fixHeaderPaths();
    
    // Load dynamic mega menu from database
    loadDynamicMegaMenu();
    
    // Add scroll animation
    initHeaderScrollAnimation();
    
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize mobile dropdowns
    initMobileDropdowns();
    
    // Check login status and update header
    setTimeout(checkLoginStatus, 100);
}

// Detect the base path of the application
function getBasePath() {
    const scripts = document.getElementsByTagName('script');
    for (let script of scripts) {
        const src = script.src;
        if (src.includes('header-init.js')) {
            // Extract the base path from the script src
            // e.g., if src is "https://example.com/build/js/header-init.js"
            // basePath should be "/build/"
            const url = new URL(src);
            const path = url.pathname;
            // Remove "/js/header-init.js" from the end
            const basePath = path.replace(/\/js\/header-init\.js$/, '');
            return basePath || '';
        }
    }
    return '';
}

// Load header component and initialize it
function loadHeader() {
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (!headerPlaceholder) {
        console.error('Header placeholder not found');
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
    
    const headerPath = needsParentDir ? '../components/header.html' : 'components/header.html';
    
    console.log('Base path:', basePath);
    console.log('Current path:', currentPath);
    console.log('Relative path:', relativePath);
    console.log('Loading header from:', headerPath);
    
    fetch(headerPath)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            headerPlaceholder.innerHTML = data;
            // Initialize header after it's loaded
            initializeHeader();
        })
        .catch(error => {
            console.error('Error loading header:', error);
            console.error('Header path attempted:', headerPath);
        });
}

// Auto-load header when DOM is ready or immediately if already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadHeader);
} else {
    // DOM already loaded, execute immediately
    loadHeader();
}
