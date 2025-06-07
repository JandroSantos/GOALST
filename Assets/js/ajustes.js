function openSettingsModal() {
  document.getElementById("settingsModal").style.display = "flex";
}

function closeSettingsModal() {
  document.getElementById("settingsModal").style.display = "none";
}

  function generateRandomAvatar() {
    const randomSeed = Math.random().toString(36).substring(2, 10);
    document.getElementById("avatarInput").value = randomSeed;

  var svgCode = multiavatar(randomSeed);
  document.getElementById("avatarPreviewContainer").innerHTML = svgCode;
  }


