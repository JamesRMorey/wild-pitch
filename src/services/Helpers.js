export function base64ToFile(base64String, filename, mimeType) {
    // Remove the data:image/<mime-type>;base64, prefix
    const base64Data = base64String.split(',')[1];
    
    // Convert the Base64 string to a Uint8Array
    const byteCharacters = atob(base64Data);
    const byteArray = new Uint8Array(byteCharacters.length);
    
    for (let i = 0; i < byteCharacters.length; i++) {
      byteArray[i] = byteCharacters.charCodeAt(i);
    }
    
    // Create a Blob from the Uint8Array and specify the MIME type
    const blob = new Blob([byteArray], { type: mimeType });
    
    // Create a File object from the Blob with a specified filename
    const file = new File([blob], filename, { type: mimeType });
    
    return file;
}

export function getMimeTypeAndExtensionFromBase64(base64String) {
    // Extract the portion of the Base64 string that contains the MIME type
    const matches = base64String.match(/^data:(.*?);/);
    
    if (matches && matches.length === 2) {
        const mimeType = matches[1];
        
        // Extract the file extension from the MIME type
        const extension = mimeType.split('/').pop();
        
        return {
            mimeType: mimeType,
            extension: extension,
        };
    } else {
        // Default to some sensible values if MIME type cannot be determined
        return {
            mimeType: 'application/octet-stream',
            extension: 'dat',
        };
    }
  }


export function blobToFile(blob, fileName) {
    return new File([blob], fileName, { type: blob.type });
}


export function UUID() {
    // Generate a random UUID version 4
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        const r = (Math.random() * 16) | 0;
        const v = c === 'x' ? r : (r & 0x3) | 0x8;
        return v.toString(16);
    });
}


export function getFileExtensionFromBlob(blob) {
    const mimeType = blob.type;
    const mimeParts = mimeType.split('/'); // Split MIME type into parts
  
    if (mimeParts.length === 2) {
        // If MIME type has two parts (e.g., "image/png"), get the second part as the extension
        const extension = mimeParts[1];
        return extension;
    } else {
      // If MIME type does not have two parts, return an empty string or handle it as needed
           return '';
    }
}
  
