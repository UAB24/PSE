const loginBtn = document.getElementById('login-btn');
const newArticleSection = document.getElementById('new-article');
const articleForm = document.getElementById('article-form');
const articleList = document.getElementById('article-list');
const loginError = document.getElementById('login-error');
let articles = JSON.parse(localStorage.getItem('articles')) || [];
let loggedIn = false;

// Credentials 
const adminUsername = "admin";
const adminPassword = "admin";

loginBtn.addEventListener('click', () => {
    if (!loggedIn) {
        const username = prompt("Enter username:");
        const password = prompt("Enter password:");
        if (username === adminUsername && password === adminPassword) {
            loggedIn = true;
            loginBtn.textContent = "Logout";
            newArticleSection.style.display = "block";
            loginError.textContent = '';
        } else {
            loginError.textContent = 'Invalid username or password';
            return; 
        }
    } else {
        loggedIn = false;
        loginBtn.textContent = "Login as Admin";
        newArticleSection.style.display = "none";
    }
    displayArticles();
});

articleForm.addEventListener('submit', event => {
    event.preventDefault(); 
    console.log("Attempting to add article"); 
    if (loggedIn) {
        const title = document.getElementById('title').value;
        const content = document.getElementById('content').value;
        if (title && content) {
            addArticle(title, content);
            articleForm.reset(); // Clear form after submission
        } else {
            console.error("Title or content missing!"); 
        }
    } else {
        console.error("Not logged in!");
        alert("Please login to publish articles");
    }
});

function addArticle(title, content) {
    const newArticle = {
        id: new Date().toISOString(),
        title,
        content,
        date: new Date().toISOString()
    };
    articles.push(newArticle);
    localStorage.setItem('articles', JSON.stringify(articles));
    displayArticles();
}

function displayArticles() {
    articleList.innerHTML = '';
    articles.sort((a, b) => new Date(b.date) - new Date(a.date))
        .forEach(article => {
            const articleItem = document.createElement('li');
            articleItem.innerHTML = `<h3>${article.title}</h3><p>${article.content}</p><small>Posted on ${new Date(article.date).toLocaleString()}</small>`;
            articleList.appendChild(articleItem);
        });
}
