const tasks = document.getElementById('tasklist');

if (tasklist) {
  tasklist.addEventListener('click', e => {
    if (e.target.className === 'material-icons') {
      if (confirm('Are you sure?')) {
        const id = e.target.getAttribute('data-id');

        fetch(`/task/delete/${id}`, {
          method: 'DELETE'
        }).then(res => window.location.reload());
      }
    }
  });
}