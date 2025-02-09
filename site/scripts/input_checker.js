document.addEventListener('input', event => {
    if (event.target.matches('input, textarea')) {
        event.target.value = event.target.value.replace(/'/g, '');
        event.target.value = event.target.value.replace(/`/g, '');
        event.target.value = event.target.value.replace(/"/g, '');
        event.target.value = event.target.value.replace(/;/g, '');
        event.target.value = event.target.value.replace(/-/g, '');
        event.target.value = event.target.value.replace(/#/g, '');
        event.target.value = event.target.value.replace(/=/g, '');
        event.target.value = event.target.value.replace(/|/g, '');
        event.target.value = event.target.value.replace(/>/g, '');
        event.target.value = event.target.value.replace(/</g, '');
        event.target.value = event.target.value.replace(/&/g, '');
        event.target.value = event.target.value.replace(/^/g, '');
    }
});
