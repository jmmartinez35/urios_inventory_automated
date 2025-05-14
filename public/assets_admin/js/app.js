function updateSlug() {
    const nameInput = document.getElementById('category_name');
    const slugInput = document.getElementById('category_slug');

    nameInput.addEventListener('input', function () {
        const name = nameInput.value.trim(); // Trim whitespace from the beginning and end
        const spaceIndex = name.indexOf(' ');
        let slug;

        if (spaceIndex === -1) {
            slug = name.toLowerCase(); // No space found, use the entire name
        } else {
            // Replace spaces with hyphens
            slug = name.toLowerCase().replace(/\s+/g, '-');
        }

        slugInput.value = slug;
    });
}



document.addEventListener('DOMContentLoaded', function () {
    updateSlug();

    
});
