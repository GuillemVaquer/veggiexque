// While a province dropdown is open, pressing a letter scrolls its menu
// to the first province whose slug starts with that letter.
const provinceMenus = document.querySelectorAll('.province-dropdown .dropdown-menu');

document.addEventListener('keydown', (event) => {
    if (event.ctrlKey || event.metaKey || event.altKey) return;
    if (!/^[a-z]$/i.test(event.key)) return;

    const target = event.target;
    if (target && (target.isContentEditable ||
        /^(INPUT|TEXTAREA|SELECT)$/.test(target.tagName || ''))) return;

    const letter = event.key.toLowerCase();
    for (const menu of provinceMenus) {
        if (!menu.classList.contains('show')) continue;
        const item = menu.querySelector(`[data-slug^="${letter}"]`);
        if (!item) continue;
        menu.scrollTo({ top: item.offsetTop, behavior: 'smooth' });
        event.preventDefault();
        break;
    }
});
