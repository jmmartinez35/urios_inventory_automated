document.addEventListener('livewire:init', () => {
    console.log("Livewire initialized"); // Check if Livewire is loading properly

    Livewire.on("userStatusUpdatedJS", () => {
        console.log("✅ Livewire event received in Status component.");
        alert("xaxa")
        Livewire.dispatch("userStatusUpdated"); // Emit to Livewire PHP
    });
});
