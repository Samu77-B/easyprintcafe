// Enhanced AI Search Functionality for Easy Print Cafe
// This file contains the product database and AI search logic

// Product database with real product information
const productDatabase = {
    // Flags Collection
    'feather-flag': {
        name: 'Feather Flag',
        category: 'Flags',
        description: 'Eye-catching feather flags that flutter in the wind, perfect for outdoor events, promotions, and attracting attention to your business.',
        features: ['Wind-resistant design', 'Full-color printing', 'Quick setup'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/feather-flag.html',
        keywords: ['flag', 'feather', 'outdoor', 'wind', 'promotion', 'event', 'attention']
    },
    'crest-flag': {
        name: 'Crest Flag',
        category: 'Flags',
        description: 'Traditional crest shape that exudes authority and heritage branding. Ideal for institutions and formal environments.',
        features: ['Traditional crest design', 'Heavy-duty construction', 'Weather-resistant finish'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/crest-flag.html',
        keywords: ['flag', 'crest', 'traditional', 'authority', 'heritage', 'institution', 'formal']
    },
    'fin-flag': {
        name: 'Fin Flag',
        category: 'Flags',
        description: 'Modern fin design with contemporary appeal for tech and modern brands. Sleek and professional.',
        features: ['Modern fin design', 'Superior wind resistance', 'Contemporary appeal'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/fin-flag.html',
        keywords: ['flag', 'fin', 'modern', 'contemporary', 'tech', 'professional', 'sleek']
    },
    'flamingo-flag': {
        name: 'Flamingo Economy Flag',
        category: 'Flags',
        description: 'Unique flamingo shape for distinctive and memorable brand presence. Stand out from the competition.',
        features: ['Distinctive flamingo shape', 'Maximum brand visibility', 'Premium digital printing'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/flamingo-flag.html',
        keywords: ['flag', 'flamingo', 'unique', 'distinctive', 'memorable', 'brand', 'competition']
    },
    'teardrop-flag': {
        name: 'Teardrop Flag',
        category: 'Flags',
        description: 'Elegant teardrop shape combining sophistication with high visibility. Perfect for premium branding.',
        features: ['Elegant teardrop design', 'Sophisticated appeal', 'High visibility'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/teardrop-flag.html',
        keywords: ['flag', 'teardrop', 'elegant', 'sophisticated', 'premium', 'branding', 'visibility']
    },
    'arch-flag': {
        name: 'Arch Flag',
        category: 'Flags',
        description: 'Unique arch-shaped flag design for maximum visual impact and distinctive branding.',
        features: ['Unique arch design', 'Maximum visual impact', 'Distinctive branding'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/arch-flag.html',
        keywords: ['flag', 'arch', 'unique', 'visual', 'impact', 'distinctive', 'branding']
    },
    'blade-flag': {
        name: 'Blade Flag',
        category: 'Flags',
        description: 'Sleek blade-shaped flag for modern, contemporary displays with excellent wind performance.',
        features: ['Sleek blade design', 'Modern appearance', 'Excellent wind performance'],
        sizes: ['2m x 0.5m', '2.5m x 0.5m', '3m x 0.5m', 'Custom sizes available'],
        materials: ['Premium polyester fabric', 'UV-resistant printing', 'Weather-resistant finish'],
        link: 'pages/blade-flag.html',
        keywords: ['flag', 'blade', 'sleek', 'modern', 'contemporary', 'wind', 'performance']
    },
    
    // Banners and Displays
    'raptor-roller-banner': {
        name: 'Raptor Roller Banner',
        category: 'Banners',
        description: 'Professional roller banner system perfect for trade shows, exhibitions, and retail displays.',
        features: ['Professional roller system', 'Easy setup and transport', 'High-quality printing'],
        sizes: ['800mm x 2000mm', '1000mm x 2000mm', 'Custom sizes available'],
        materials: ['Premium vinyl', 'Aluminum base', 'Carry case included'],
        link: 'pages/raptor-roller-banner.html',
        keywords: ['banner', 'roller', 'trade show', 'exhibition', 'retail', 'display', 'professional']
    },
    'heras-fencing-banners': {
        name: 'Heras Fencing Banners',
        category: 'Banners',
        description: 'Large format banners designed specifically for Heras fencing systems at construction sites and events.',
        features: ['Heras fencing compatible', 'Large format printing', 'Weather-resistant'],
        sizes: ['Custom sizes to fit fencing', 'Standard panel sizes available'],
        materials: ['Heavy-duty vinyl', 'Reinforced grommets', 'UV-resistant printing'],
        link: 'pages/heras-fencing-banners.html',
        keywords: ['banner', 'heras', 'fencing', 'construction', 'site', 'event', 'large format']
    },
    'pop-out-banners': {
        name: 'Pop-Out Banners',
        category: 'Banners',
        description: 'Self-standing pop-out banners that create instant displays without additional hardware.',
        features: ['Self-standing design', 'No additional hardware needed', 'Quick setup'],
        sizes: ['800mm x 2000mm', '1000mm x 2000mm', 'Custom sizes available'],
        materials: ['Premium vinyl', 'Reinforced base', 'Carry case included'],
        link: 'pages/pop-out-banners.html',
        keywords: ['banner', 'pop-out', 'self-standing', 'display', 'quick', 'setup', 'portable']
    },
    
    // Fabric Solutions
    'stretch-fabric-walls': {
        name: 'Stretch Fabric Walls',
        category: 'Fabric Solutions',
        description: 'Premium stretch fabric wall systems for exhibitions, events, and retail environments.',
        features: ['Premium stretch fabric', 'Professional appearance', 'Easy installation'],
        sizes: ['Custom sizes available', 'Standard panel sizes'],
        materials: ['Premium stretch fabric', 'Aluminum frame system', 'Professional finish'],
        link: 'pages/stretch-fabric-walls.html',
        keywords: ['fabric', 'stretch', 'wall', 'exhibition', 'event', 'retail', 'professional']
    },
    'stretch-fabric-premium-stands': {
        name: 'Stretch Fabric Premium Stands',
        category: 'Fabric Solutions',
        description: 'High-end stretch fabric display stands for premium brand presentations.',
        features: ['Premium quality construction', 'Professional appearance', 'Durable materials'],
        sizes: ['Custom sizes available', 'Standard stand sizes'],
        materials: ['Premium stretch fabric', 'Aluminum frame', 'Professional hardware'],
        link: 'pages/stretch-fabric-premium-stands.html',
        keywords: ['fabric', 'stretch', 'premium', 'stand', 'display', 'brand', 'presentation']
    },
    'stretch-fabric-economy-stands': {
        name: 'Stretch Fabric Economy Stands',
        category: 'Fabric Solutions',
        description: 'Cost-effective stretch fabric display stands for budget-conscious businesses.',
        features: ['Cost-effective solution', 'Good quality construction', 'Easy setup'],
        sizes: ['Custom sizes available', 'Standard stand sizes'],
        materials: ['Quality stretch fabric', 'Aluminum frame', 'Standard hardware'],
        link: 'pages/stretch-fabric-economy-stands.html',
        keywords: ['fabric', 'stretch', 'economy', 'stand', 'display', 'budget', 'cost-effective']
    },
    
    // Graphics and Signage
    'crowd-barrier-graphics': {
        name: 'Crowd Barrier Graphics',
        category: 'Graphics',
        description: 'Custom graphics for crowd barriers, perfect for events, construction sites, and safety applications.',
        features: ['Custom graphics design', 'Safety compliant', 'Weather-resistant'],
        sizes: ['Standard barrier sizes', 'Custom sizes available'],
        materials: ['Heavy-duty vinyl', 'Reinforced edges', 'UV-resistant printing'],
        link: 'pages/crowd-barrier-graphics.html',
        keywords: ['barrier', 'crowd', 'graphics', 'event', 'construction', 'safety', 'custom']
    },
    'vinyl-cut-graphics': {
        name: 'Vinyl Cut Graphics and Lettering',
        category: 'Graphics',
        description: 'Precision-cut vinyl graphics and lettering for windows, vehicles, and signage applications.',
        features: ['Precision cutting', 'Multiple color options', 'Long-lasting adhesive'],
        sizes: ['Custom sizes available', 'Standard letter heights'],
        materials: ['Premium vinyl', 'Professional adhesive', 'UV-resistant'],
        link: 'pages/vinyl-cut-graphics.html',
        keywords: ['vinyl', 'cut', 'graphics', 'lettering', 'window', 'vehicle', 'signage']
    },
    
    // Small Format Products
    'posters': {
        name: 'Posters',
        category: 'Small Format',
        description: 'High-quality poster printing for promotions, events, and decorative purposes.',
        features: ['High-quality printing', 'Multiple paper options', 'Fast turnaround'],
        sizes: ['A4', 'A3', 'A2', 'A1', 'A0', 'Custom sizes'],
        materials: ['Premium paper', 'Gloss or matte finish', 'Various weights available'],
        link: 'pages/posters.html',
        keywords: ['poster', 'printing', 'promotion', 'event', 'decorative', 'quality']
    },
    'brochures': {
        name: 'Brochures',
        category: 'Small Format',
        description: 'Professional brochure printing for marketing materials and information distribution.',
        features: ['Professional printing', 'Multiple fold options', 'High-quality paper'],
        sizes: ['A4', 'A5', 'DL', 'Custom sizes'],
        materials: ['Premium paper', 'Gloss or matte finish', 'Various weights'],
        link: 'pages/brochures.html',
        keywords: ['brochure', 'printing', 'marketing', 'information', 'professional', 'fold']
    },
    'menus': {
        name: 'Menus',
        category: 'Small Format',
        description: 'Restaurant and cafe menu printing with various design and material options.',
        features: ['Restaurant quality', 'Laminated options', 'Custom designs'],
        sizes: ['A4', 'A5', 'Custom sizes'],
        materials: ['Premium paper', 'Lamination available', 'Waterproof options'],
        link: 'pages/menus.html',
        keywords: ['menu', 'restaurant', 'cafe', 'food', 'laminated', 'waterproof', 'design']
    }
};

// Enhanced AI search function
function getAIResponse(question) {
    const lowerQuestion = question.toLowerCase();
    const searchTerms = lowerQuestion.split(' ').filter(term => term.length > 2);
    
    // Check for simple product availability questions
    const availabilityQuestions = {
        'flags': {
            text: "Yes! We have a great selection of flags perfect for your business needs:",
            products: [
                { name: "Feather Flag", link: "pages/feather-flag.html", category: "Flags", description: "Eye-catching flags that flutter in the wind" },
                { name: "Crest Flag", link: "pages/crest-flag.html", category: "Flags", description: "Traditional crest shape for authority and heritage" },
                { name: "Fin Flag", link: "pages/fin-flag.html", category: "Flags", description: "Modern fin design with contemporary appeal" },
                { name: "Flamingo Flag", link: "pages/flamingo-flag.html", category: "Flags", description: "Unique flamingo shape for distinctive branding" },
                { name: "Teardrop Flag", link: "pages/teardrop-flag.html", category: "Flags", description: "Elegant teardrop shape for premium branding" }
            ]
        },
        'banners': {
            text: "Absolutely! We offer various banner solutions for your business:",
            products: [
                { name: "Pop Out Banners", link: "pages/pop-out-banners.html", category: "Banners", description: "Professional retractable banners" },
                { name: "Raptor Banner", link: "pages/raptor-banner.html", category: "Banners", description: "Heavy-duty outdoor banners" },
                { name: "Fabric Exhibition Banner", link: "pages/fabric-exhibition-banner.html", category: "Banners", description: "Premium fabric banners for exhibitions" }
            ]
        },
        'posters': {
            text: "Yes! We provide high-quality poster printing services:",
            products: [
                { name: "Poster Printing", link: "pages/poster-printing.html", category: "Posters", description: "Professional poster printing in various sizes" }
            ]
        },
        'menus': {
            text: "Of course! We specialize in menu printing for restaurants and cafes:",
            products: [
                { name: "Menus", link: "pages/menus.html", category: "Menus", description: "Restaurant and cafe menu printing" },
                { name: "Table Talkers", link: "pages/table-talkers.html", category: "Menus", description: "Table display menus and promotions" }
            ]
        },
        'business cards': {
            text: "Yes! We offer professional business card printing:",
            products: [
                { name: "Business Cards", link: "pages/business-cards.html", category: "Business Cards", description: "Premium business card printing" }
            ]
        },
        'stickers': {
            text: "Absolutely! We have various sticker and label options:",
            products: [
                { name: "Cut Vinyl Graphics", link: "pages/cut-vinyl-graphics.html", category: "Stickers", description: "Custom vinyl stickers and graphics" }
            ]
        }
    };
    
    // Check for simple availability questions
    for (const [product, response] of Object.entries(availabilityQuestions)) {
        if (lowerQuestion.includes(product) && 
            (lowerQuestion.includes('do you have') || 
             lowerQuestion.includes('do you sell') || 
             lowerQuestion.includes('have you got') ||
             lowerQuestion.includes('can you do') ||
             lowerQuestion.includes('do you offer') ||
             lowerQuestion.includes('available') ||
             lowerQuestion.includes('?'))) {
            return response;
        }
    }
    
    // Enhanced business scenario responses with contextual messaging
    const businessScenarios = {
        'cafe': {
            text: "Perfect! For your cafe, these products will create the ideal welcoming atmosphere and help you communicate with customers effectively:",
            products: [
                { name: "Menus", link: "pages/menus.html", category: "Menu Display" },
                { name: "Table Talkers", link: "pages/table-talkers.html", category: "Table Display" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Posters", link: "pages/posters.html", category: "Promotional" }
            ]
        },
        'restaurant': {
            text: "Great choice! For your restaurant, these products will give you the professional presentation and clear communication you need:",
            products: [
                { name: "Menus", link: "pages/menus.html", category: "Menu Display" },
                { name: "Table Talkers", link: "pages/table-talkers.html", category: "Table Display" },
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" }
            ]
        },
        'retail': {
            text: "Excellent! For your retail business, these products will help you attract customers and drive sales effectively:",
            products: [
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Point of Sale" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Stretch Fabric Walls", link: "pages/stretch-fabric-walls.html", category: "Display" }
            ]
        },
        'events': {
            text: "Perfect! For your event, we believe these products will help you stand out from the crowd and create maximum impact:",
            products: [
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Point of Sale" },
                { name: "Stretch Fabric Walls", link: "pages/stretch-fabric-walls.html", category: "Display" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Crowd Barrier Graphics", link: "pages/crowd-barrier-graphics.html", category: "Safety" }
            ]
        },
        'popup': {
            text: "Fantastic! For your popup shop, we think these products would be perfect for creating an eye-catching temporary display that draws customers in:",
            products: [
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Portable Display" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Posters", link: "pages/posters.html", category: "Promotional" }
            ]
        },
        'pop-up': {
            text: "Fantastic! For your pop-up shop, we think these products would be perfect for creating an eye-catching temporary display that draws customers in:",
            products: [
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Portable Display" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Posters", link: "pages/posters.html", category: "Promotional" }
            ]
        },
        'tradeshow': {
            text: "Excellent! For your trade show, we believe these products will help you make a strong impression and stand out from competitors:",
            products: [
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Professional Display" },
                { name: "Stretch Fabric Walls", link: "pages/stretch-fabric-walls.html", category: "Backdrop" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Portable Display" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Attention Grabber" },
                { name: "Brochures", link: "pages/brochures.html", category: "Takeaway Material" }
            ]
        },
        'trade show': {
            text: "Excellent! For your trade show, we believe these products will help you make a strong impression and stand out from competitors:",
            products: [
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Professional Display" },
                { name: "Stretch Fabric Walls", link: "pages/stretch-fabric-walls.html", category: "Backdrop" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Portable Display" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Attention Grabber" },
                { name: "Brochures", link: "pages/brochures.html", category: "Takeaway Material" }
            ]
        },
        'office': {
            text: "Perfect! For your office, we think these products will create a professional environment and help with wayfinding and branding:",
            products: [
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Posters", link: "pages/posters.html", category: "Internal Communication" },
                { name: "Brochures", link: "pages/brochures.html", category: "Marketing Materials" },
                { name: "Business Cards", link: "pages/business-cards.html", category: "Professional Networking" }
            ]
        },
        'construction': {
            text: "Great! For your construction site, we believe these products will provide excellent safety communication and site branding:",
            products: [
                { name: "Heras Fencing Banners", link: "pages/heras-fencing-banners.html", category: "Site Signage" },
                { name: "Crowd Barrier Graphics", link: "pages/crowd-barrier-graphics.html", category: "Safety Signage" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Site Identification" },
                { name: "Posters", link: "pages/posters.html", category: "Safety Information" }
            ]
        }
    };

    // Check for business type keywords
    for (const [businessType, data] of Object.entries(businessScenarios)) {
        if (lowerQuestion.includes(businessType)) {
            return data;
        }
    }

    // Search through product database
    const matchingProducts = [];
    const productEntries = Object.entries(productDatabase);
    
    for (const [key, product] of productEntries) {
        let relevanceScore = 0;
        
        // Check product name
        if (product.name.toLowerCase().includes(lowerQuestion)) {
            relevanceScore += 10;
        }
        
        // Check keywords
        for (const keyword of product.keywords) {
            if (lowerQuestion.includes(keyword)) {
                relevanceScore += 5;
            }
        }
        
        // Check description
        if (product.description.toLowerCase().includes(lowerQuestion)) {
            relevanceScore += 3;
        }
        
        // Check features
        for (const feature of product.features) {
            if (lowerQuestion.includes(feature.toLowerCase())) {
                relevanceScore += 2;
            }
        }
        
        // Check category
        if (lowerQuestion.includes(product.category.toLowerCase())) {
            relevanceScore += 4;
        }
        
        if (relevanceScore > 0) {
            matchingProducts.push({ ...product, relevanceScore, key });
        }
    }
    
    // Sort by relevance score
    matchingProducts.sort((a, b) => b.relevanceScore - a.relevanceScore);
    
    if (matchingProducts.length > 0) {
        const topProducts = matchingProducts.slice(0, 5);
        
        // Create personalized response based on the user's specific question
        let contextualText = "";
        if (lowerQuestion.includes('what') || lowerQuestion.includes('which')) {
            contextualText = `Here are ${matchingProducts.length} product${matchingProducts.length > 1 ? 's' : ''} that would be perfect for your needs:`;
        } else if (lowerQuestion.includes('need') || lowerQuestion.includes('should')) {
            contextualText = `These ${matchingProducts.length} product${matchingProducts.length > 1 ? 's' : ''} would work best for what you need:`;
        } else if (lowerQuestion.includes('recommend') || lowerQuestion.includes('suggest')) {
            contextualText = `I'd recommend these ${matchingProducts.length} product${matchingProducts.length > 1 ? 's' : ''} for you:`;
        } else if (lowerQuestion.includes('help') || lowerQuestion.includes('advice')) {
            contextualText = `I can help you with these ${matchingProducts.length} product${matchingProducts.length > 1 ? 's' : ''}:`;
        } else {
            contextualText = `These ${matchingProducts.length} product${matchingProducts.length > 1 ? 's' : ''} would be ideal for you:`;
        }
        
        return {
            text: contextualText,
            products: topProducts.map(product => ({
                name: product.name,
                link: product.link,
                category: product.category,
                description: product.description
            }))
        };
    }

    // Enhanced fallback responses for common queries
    if (lowerQuestion.includes('flag')) {
        return {
            text: "Perfect! Our flag collection would be ideal for your needs. Here are our flag options:",
            products: [
                { name: "Feather Flag", link: "pages/feather-flag.html", category: "Flags" },
                { name: "Crest Flag", link: "pages/crest-flag.html", category: "Flags" },
                { name: "Fin Flag", link: "pages/fin-flag.html", category: "Flags" },
                { name: "Flamingo Flag", link: "pages/flamingo-flag.html", category: "Flags" },
                { name: "Teardrop Flag", link: "pages/teardrop-flag.html", category: "Flags" }
            ]
        };
    }

    if (lowerQuestion.includes('banner')) {
        return {
            text: "Great choice! Our banner solutions would work perfectly for your project. Here are our banner options:",
            products: [
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Banners" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Banners" },
                { name: "Heras Fencing Banners", link: "pages/heras-fencing-banners.html", category: "Banners" }
            ]
        };
    }

    if (lowerQuestion.includes('menu') || lowerQuestion.includes('food')) {
        return {
            text: "Excellent! For food service businesses, these products would be perfect for your menu displays:",
            products: [
                { name: "Menus", link: "pages/menus.html", category: "Menu Display" },
                { name: "Table Talkers", link: "pages/table-talkers.html", category: "Table Display" },
                { name: "Posters", link: "pages/posters.html", category: "Promotional" },
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" }
            ]
        };
    }

    if (lowerQuestion.includes('sign') || lowerQuestion.includes('signage')) {
        return {
            text: "Perfect! Our signage solutions would be ideal for your business. Here are our signage options:",
            products: [
                { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Exterior Signage" },
                { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
                { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Promotional" },
                { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Point of Sale" }
            ]
        };
    }

    // Enhanced default response
    return {
        text: "I'd be happy to help you find the perfect printing solutions! These popular products might be exactly what you need:",
        products: [
            { name: "Feather Flag", link: "pages/feather-flag.html", category: "Flags" },
            { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Banners" },
            { name: "Menus", link: "pages/menus.html", category: "Small Format" },
            { name: "Window Graphics", link: "pages/vinyl-cut-graphics.html", category: "Graphics" },
            { name: "Stretch Fabric Walls", link: "pages/stretch-fabric-walls.html", category: "Fabric Solutions" }
        ]
    };
}

// Enhanced display function with typing effect
function displayAIResponse(question) {
    const aiResponse = document.getElementById('aiResponse');
    const aiText = aiResponse.querySelector('.ai-text');
    const aiProducts = aiResponse.querySelector('.ai-products');
    
    const response = getAIResponse(question);
    
    // Clear previous content
    aiText.textContent = '';
    aiProducts.innerHTML = '';
    
    // Show the response container
    aiResponse.style.display = 'block';
    
    // Typewriter effect for the text
    let textIndex = 0;
    const fullText = response.text;
    const typingSpeed = 50; // milliseconds per character
    
    function typeText() {
        if (textIndex < fullText.length) {
            aiText.textContent += fullText.charAt(textIndex);
            textIndex++;
            setTimeout(typeText, typingSpeed);
        } else {
            // After typing is complete, show the products
            setTimeout(() => {
                response.products.forEach(product => {
                    const productDiv = document.createElement('div');
                    productDiv.className = 'ai-product-item';
                    
                    const productLink = document.createElement('a');
                    productLink.href = product.link;
                    productLink.className = 'ai-product-link';
                    productLink.innerHTML = `
                        <div class="ai-product-name">${product.name}</div>
                        <div class="ai-product-category">${product.category}</div>
                        ${product.description ? `<div class="ai-product-description">${product.description}</div>` : ''}
                    `;
                    
                    productDiv.appendChild(productLink);
                    aiProducts.appendChild(productDiv);
                });
            }, 500); // Small delay before showing products
        }
    }
    
    // Start typing effect
    typeText();
}
