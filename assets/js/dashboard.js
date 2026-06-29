(() => {
    document.querySelectorAll('[data-auto-submit]').forEach((control) => {
        control.addEventListener('change', () => control.form?.submit());
    });

    const searchInput = document.querySelector('[data-search-input]');
    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            searchInput.value = '';
            searchInput.form?.submit();
        }
    });
})();
