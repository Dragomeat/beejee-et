import 'bootstrap';
import '@fortawesome/fontawesome-free';

const logout = document.getElementById('logout-button');

if (logout) {
    logout.addEventListener('click', (event) => {
        event.preventDefault();

        const form = document.getElementById('logout-form');

        form.submit();
    });
}
