document.addEventListener('DOMContentLoaded', () => {
 
    const menuToggle = document.getElementById('menu-toggle');
     const nav = document.getElementById('main-nav');
   
     menuToggle.addEventListener('click', () => {
       nav.classList.toggle('show');
     });
   
   });

document.addEventListener('DOMContentLoaded', function() {
  const userAvatar = document.getElementById('userAvatar');
  const avatarDropdown = document.getElementById('avatarDropdown');
  
  if (userAvatar && avatarDropdown) {
    userAvatar.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      console.log('Avatar clicked');
      
      avatarDropdown.classList.toggle('show');
    });
    
    document.addEventListener('click', function(e) {
      if (!userAvatar.contains(e.target) && !avatarDropdown.contains(e.target)) {
        avatarDropdown.classList.remove('show');
      }
    });
    
    avatarDropdown.addEventListener('click', function(e) {
      e.stopPropagation();
    });
  } else {
    console.log('Avatar elements not found:', {
      userAvatar: userAvatar,
      avatarDropdown: avatarDropdown
    });
  }
});

