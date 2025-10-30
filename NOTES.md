# Easy Print Cafe - Website Notes

## AI Search System

### Location
- **File**: `js/ai-search.js`
- Contains product database and AI search logic

### How It Works
The AI search has three main components:

1. **Product Database** (lines 5-195)
   - All products with descriptions, features, keywords
   - Used for keyword matching

2. **Business Scenarios** (lines 264-363)
   - Pre-defined scenarios for specific business types
   - Matches keywords like 'cafe', 'restaurant', 'retail', etc.
   - Returns curated product recommendations

3. **Search Logic** (lines 198-504)
   - Matches user questions to products
   - Scores relevance based on keywords
   - Returns personalized responses

### Adding Custom Scenarios

To add new business scenarios (e.g., crafts stall, market vendor, art exhibition):

**Example for Crafts Stall:**
```javascript
'crafts stall': {
    text: "Perfect! For your crafts stall at the fair, these products will help attract customers and showcase your artwork:",
    products: [
        { name: "Feather Flags", link: "pages/feather-flag.html", category: "Outdoor Signage" },
        { name: "Pop-Out Banners", link: "pages/pop-out-banners.html", category: "Portable Display" },
        { name: "Posters", link: "pages/posters.html", category: "Art Display" },
        { name: "Table Talkers", link: "pages/table-talkers.html", category: "Table Display" }
    ]
},
'market stall': {
    text: "Excellent! For your market stall, these products will make your booth stand out:",
    products: [
        { name: "Feather Flags", link: "pages/feather-flag.html", category: "Attention Grabber" },
        { name: "Raptor Roller Banner", link: "pages/raptor-roller-banner.html", category: "Professional Display" },
        { name: "Posters", link: "pages/posters.html", category: "Promotional" }
    ]
}
```

**Add these inside the `businessScenarios` object around line 264**

### Current Scenarios Available
- cafe
- restaurant  
- retail
- events
- popup / pop-up
- tradeshow / trade show
- office
- construction

### Future Scenario Ideas
- [ ] Crafts stall / Art fair
- [ ] Farmers market
- [ ] Art gallery / exhibition
- [ ] Food truck
- [ ] Festival vendor
- [ ] Wedding business
- [ ] School / University
- [ ] Gym / Fitness center

### Testing AI Search
Use the debug tool: `debug-ai-search.html`

Test queries:
- "What do I need for a cafe?"
- "I have a crafts stall at a fair selling my paintings"
- "Show me flags"
- "What's best for a market stall?"

---

## General Website Notes

### Important Files
- `/components/header.html` - Main navigation header
- `/components/footer.html` - Site footer
- `/components/header.css` - Header styling
- `/js/ai-search.js` - AI search functionality
- `/styles.css` - Main stylesheet

### Recent Changes
- Desktop nav button spacing increased from 0.75rem to 1rem

---

## Ideas & To-Do Items

### Future Enhancements
- Add more AI search scenarios for different business types
- 

### Bugs to Fix
- 

### Content Updates Needed
- 

---

## Notes Template
_Use this section for quick notes, ideas, or reminders_

**Date**: October 10, 2025
- Discussed AI search customization
- Need to add crafts stall/market vendor scenarios

---

