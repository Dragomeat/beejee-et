const checkboxes = document.getElementsByClassName('change-task-status');

Object.values(checkboxes).forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        event.preventDefault();

        const form = document.getElementById('complete-form');

        const id = checkbox.getAttribute('data-id');

        const action = event.currentTarget.checked
            ? 'complete'
            : 'activate';

        form.action = `/tasks/${id}/${action}`;
        form.submit();
    });
});
