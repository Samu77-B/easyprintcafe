# AI Search Troubleshooting Guide

## Common Issues and Solutions

### 1. **JavaScript File Not Loading**
**Symptoms**: AI search button does nothing, no response when typing
**Solution**: 
- Check if `js/ai-search.js` exists and is uploaded
- Verify the file path in `index.html` is correct: `<script src="js/ai-search.js"></script>`
- Check browser console for 404 errors

### 2. **Path Issues**
**Symptoms**: JavaScript errors in console about missing files
**Solution**:
- Make sure `js/ai-search.js` is in the correct location
- If you're on a subpage, the path might need to be `../js/ai-search.js`

### 3. **JavaScript Errors**
**Symptoms**: Console shows JavaScript errors
**Solution**:
- Open browser Developer Tools (F12)
- Check Console tab for errors
- Look for syntax errors or missing functions

### 4. **AI Search Not Responding**
**Symptoms**: Button works but no AI response appears
**Solution**:
- Check if `displayAIResponse` function is working
- Verify the AI response container exists in HTML

## Quick Diagnostic Steps

### Step 1: Upload Debug Tool
1. Upload `debug-ai-search.html` to your website
2. Visit: `https://yourdomain.com/debug-ai-search.html`
3. Check the diagnostic results

### Step 2: Test AI Search Manually
Try these test queries:
- "What do I need for a cafe?"
- "Show me flags"
- "I need posters for my restaurant"

### Step 3: Check Browser Console
1. Press F12 to open Developer Tools
2. Go to Console tab
3. Look for any red error messages
4. Try the AI search and watch for errors

## Quick Fixes

### Fix 1: Ensure JavaScript File is Uploaded
Make sure `js/ai-search.js` is uploaded to your server in the correct location.

### Fix 2: Check HTML Script Tag
In your `index.html`, make sure this line exists:
```html
<script src="js/ai-search.js"></script>
```

### Fix 3: Test with Simple Query
Try asking: "What do I need for a cafe?" - this should definitely work if the system is functioning.

### Fix 4: Check File Permissions
Ensure the JavaScript file has proper read permissions (644).

## Manual Test

You can test the AI search manually by opening browser console and typing:
```javascript
getAIResponse("What do I need for a cafe?")
```

This should return a response object with text and products.

## Contact Support

If none of these solutions work, please provide:
1. The exact error message from browser console
2. What happens when you click the AI search button
3. Whether the debug tool shows any issues
4. Your website URL for testing
