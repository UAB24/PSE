document.addEventListener('DOMContentLoaded', () => {
    const addPostButton = document.getElementById('add-post-btn');
    const postTitleInput = document.getElementById('post-title');
    const postContentInput = document.getElementById('post-content');
    const postsSection = document.getElementById('posts');
    const clearStorageButton = document.getElementById('clear-storage-btn');
    const loginButton = document.getElementById('login-btn');
    const logoutButton = document.getElementById('logout-btn');
    const newPostSection = document.getElementById('new-post-section');
    const loginError = document.getElementById('login-error');

    let loggedIn = false;


    const adminUsername = "test";
    const adminPassword = "test";

    function renderPosts() {
        let blogPosts = JSON.parse(localStorage.getItem('blogPosts')) || [];
        blogPosts.sort((a, b) => new Date(b.date) - new Date(a.date));
        postsSection.innerHTML = '';
        blogPosts.forEach(post => {
            const postElement = document.createElement('article');
            postElement.innerHTML = `
                <h2>${post.title}</h2>
                <p>${post.content}</p>
                <small>${new Date(post.date).toLocaleString()}</small>
                <div class="comments-section">
                    <h3>Comentarii</h3>
                    <ul id="comments-${post.id}"></ul>
                    <form class="comment-form" data-post-id="${post.id}">
                        <input type="text" placeholder="Nume" class="comment-name">
                        <textarea placeholder="Comentariu" class="comment-text"></textarea>
                        <button type="submit">Adaugă Comentariu</button>
                    </form>
                </div>
            `;
            postsSection.appendChild(postElement);
            renderComments(post.id, post.comments);
        });
    }


    function renderComments(postId, comments) {
        const commentsList = document.getElementById(`comments-${postId}`);
        commentsList.innerHTML = '';
        if (comments) {
            comments.forEach(comment => {
                const commentItem = document.createElement('li');
                commentItem.innerHTML = `<b>${comment.name}</b>: ${comment.text}`;
                commentsList.appendChild(commentItem);
            });
        }
    }

    addPostButton.addEventListener('click', () => {
        const title = postTitleInput.value;
        const content = postContentInput.value;
        if (title && content) {
            const newPost = { 
                id: new Date().toISOString(),
                title,
                content,
                date: new Date().toISOString(),
                comments: []
            };
            let blogPosts = JSON.parse(localStorage.getItem('blogPosts')) || [];
            blogPosts.push(newPost);
            localStorage.setItem('blogPosts', JSON.stringify(blogPosts));
            renderPosts();
            postTitleInput.value = '';
            postContentInput.value = '';
        } else {
            alert('Vă rugăm să completați atât titlul cât și conținutul.');
        }
    });

    document.addEventListener('submit', event => {
        if (event.target && event.target.matches('.comment-form')) {
            event.preventDefault();
            const postId = event.target.getAttribute('data-post-id');
            const name = event.target.querySelector('.comment-name').value;
            const text = event.target.querySelector('.comment-text').value;
            if (name && text) {
                const comment = { name, text };
                let blogPosts = JSON.parse(localStorage.getItem('blogPosts')) || [];
                const postIndex = blogPosts.findIndex(post => post.id === postId);
                if (postIndex !== -1) {
                    blogPosts[postIndex].comments.push(comment);
                    localStorage.setItem('blogPosts', JSON.stringify(blogPosts));
                    renderComments(postId, blogPosts[postIndex].comments);
                    event.target.reset();
                } else {
                    console.error(`Post with ID ${postId} not found.`);
                }
            } else {
                alert('Vă rugăm să completați atât numele cât și comentariul.');
            }
        }
    });


    clearStorageButton.addEventListener('click', () => {
        localStorage.removeItem('blogPosts');
        renderPosts();
    });


    loginButton.addEventListener('click', () => {
        const username = prompt("Introduceți numele de utilizator:");
        const password = prompt("Introduceți parola:");
        if (username === adminUsername && password === adminPassword) {
            loggedIn = true;
            loginButton.style.display = 'none';
            logoutButton.style.display = 'inline';
            newPostSection.style.display = 'block';
            loginError.textContent = '';
        } else {
            loginError.textContent = 'Nume de utilizator sau parolă incorectă';
        }
    });

    logoutButton.addEventListener('click', () => {
        loggedIn = false;
        loginButton.style.display = 'inline';
        logoutButton.style.display = 'none';
        newPostSection.style.display = 'none';
    });

    renderPosts();
});
