document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const errorMessage = document.getElementById('error-message');
    
    const hardcodedUsername = 'test';
    const hardcodedPassword = 'test';
    const user = {
        name: 'Băcănaru Silviu',
        job: 'Fullstack Developer',
        photo: 'https://media.licdn.com/dms/image/D4D03AQGKFsZGPwslSA/profile-displayphoto-shrink_800_800/0/1712658677520?e=1721865600&v=beta&t=6fJGRtESnQwAhNNab4j5TaY4I7BbWOnT8jNPQPiREeI',
        description: 'Sunt un Fullstack Developer, orientat pe server side, cu experiență un utilizarea tehnologiilor moderne de dezvoltare web.'
    };
    
    if (username === hardcodedUsername && password === hardcodedPassword) {
        document.getElementById('login-page').style.display = 'none';
        document.getElementById('user-name').textContent = user.name;
        document.getElementById('user-job').textContent = user.job;
        document.getElementById('user-photo').src = user.photo;
        document.getElementById('user-description').textContent = user.description;
        document.getElementById('personal-page').style.display = 'flex';
    } else {
        errorMessage.textContent = 'Invalid username or password.';
    }
});

document.getElementById('add-question-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const topic = document.getElementById('topic').value;
    const question = document.getElementById('question').value;
    const asker = document.getElementById('asker').value;
    
    if (topic && question && asker) {
        const questionsList = document.getElementById('questions');
        const newQuestion = document.createElement('li');
        newQuestion.innerHTML = `<strong>Topic:</strong> ${topic}<br><strong>Question:</strong> ${question}<br><strong>Asker:</strong> ${asker}`;
        
        questionsList.appendChild(newQuestion);
        
        document.getElementById('topic').value = '';
        document.getElementById('question').value = '';
        document.getElementById('asker').value = '';
    }
});

document.getElementById('donation-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const amount = document.getElementById('amount').value;
    const reason = document.getElementById('reason').value;
    const payer = document.getElementById('payer').value;
    
    if (amount && reason && payer) {
        alert(`Mulțumesc, ${payer}, pentru donația de ${amount} RON!`);
        
        document.getElementById('amount').value = '5';
        document.getElementById('reason').value = '';
        document.getElementById('payer').value = '';
    }
});
