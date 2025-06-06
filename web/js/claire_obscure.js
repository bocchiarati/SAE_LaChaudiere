export function load_claire_obscure() {
    const toggle = document.getElementById('theme-toggle');
    toggle.addEventListener('click', () => {
        console.log("click")
        document.documentElement.classList.toggle('dark');
    });
}