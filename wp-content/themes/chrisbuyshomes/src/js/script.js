document.addEventListener('DOMContentLoaded', () => {
    // console.log('Interactivity API loaded');

    // Add your interactivity logic here
    // Example: Adding a click event listener to a custom block
    const blockElement = document.querySelector('.wp-block-doctor-homes-blocks-my-block');
    if (blockElement) {
        blockElement.addEventListener('click', () => {
            alert('Block clicked!');
        });
    }
});
