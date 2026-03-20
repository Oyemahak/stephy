const questionCard = document.getElementById("questionCard");
const successCard = document.getElementById("successCard");
const yesBtn = document.getElementById("yesBtn");
const noBtn = document.getElementById("noBtn");
const playAgainBtn = document.getElementById("playAgainBtn");
const subText = document.getElementById("subText");
const mainGif = document.getElementById("mainGif");
const buttonStage = document.getElementById("buttonStage");

const hoverMessages = [
  "No 😶",
  "Are you sure? 🥺",
  "Think again please 💭",
  "Just one tiny yes? 🌸",
  "Pookie please... 🥹",
  "I’ll be very sad... 💔",
  "Don’t do this to me 😭",
  "Still no? really? 👀",
  "Final chance? 💗",
  "Let’s cancel 😔"
];

const subTexts = [
  "Please choose carefully... my heart is watching.",
  "That 'No' looked suspicious. Try again.",
  "I feel like this should be a yes moment.",
  "The 10th April plan is looking too cute to miss.",
  "At this point the Yes button is emotionally stronger.",
  "I am politely requesting a better decision.",
  "This is becoming a very dramatic situation.",
  "Even the cute gif believes the answer is yes.",
  "One last thoughtful review before you decide.",
  "Let’s cancel is here now... but good luck catching it."
];

const gifStates = [
  "https://media.giphy.com/media/3oriO0OEd9QIDdllqo/giphy.gif",
  "https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif",
  "https://media.giphy.com/media/9Y5BbDSkSTiY8/giphy.gif",
  "https://media.giphy.com/media/VbnUQpnihPSIgIXuZv/giphy.gif",
  "https://media.giphy.com/media/ICOgUNjpvO0PC/giphy.gif",
  "https://media.giphy.com/media/26BRv0ThflsHCqDrG/giphy.gif",
  "https://media.giphy.com/media/42YlR8u9gV5Cw/giphy.gif",
  "https://media.giphy.com/media/fdMqY8aY6M3H2/giphy.gif",
  "https://media.giphy.com/media/3oriO6qJiXajN0TyDu/giphy.gif",
  "https://media.giphy.com/media/3oz8xIsloV7zOmt81G/giphy.gif"
];

let hoverCount = 0;
let yesScale = 1;
let isFinalStage = false;

function setButtonPosition(x, y) {
  noBtn.style.left = `${x}px`;
  noBtn.style.top = `${y}px`;
}

function getSafeBounds() {
  const stageRect = buttonStage.getBoundingClientRect();
  const noRect = noBtn.getBoundingClientRect();

  const maxX = Math.max(0, stageRect.width - noRect.width - 10);
  const maxY = Math.max(0, stageRect.height - noRect.height - 10);

  return { maxX, maxY };
}

function moveNoButtonRandomly() {
  const { maxX, maxY } = getSafeBounds();

  const randomX = Math.floor(Math.random() * (maxX + 1));
  const randomY = Math.floor(Math.random() * (maxY + 1));

  setButtonPosition(randomX, randomY);
}

function updateYesButton() {
  yesScale += 0.18;
  yesBtn.style.transform = `scale(${yesScale})`;
}

function updateNoStage() {
  const index = Math.min(hoverCount, hoverMessages.length - 1);

  noBtn.textContent = hoverMessages[index];
  subText.textContent = subTexts[index];
  mainGif.src = gifStates[index];

  updateYesButton();

  if (index === hoverMessages.length - 1) {
    isFinalStage = true;
  }
}

function handleNoInteraction(event) {
  event.preventDefault();

  if (hoverCount < hoverMessages.length - 1) {
    hoverCount += 1;
  }

  updateNoStage();
  moveNoButtonRandomly();
}

function handleFinalNoMouseMove(event) {
  if (!isFinalStage) return;

  const noRect = noBtn.getBoundingClientRect();
  const pointerX = event.clientX;
  const pointerY = event.clientY;

  const nearX = pointerX > noRect.left - 70 && pointerX < noRect.right + 70;
  const nearY = pointerY > noRect.top - 70 && pointerY < noRect.bottom + 70;

  if (nearX && nearY) {
    moveNoButtonRandomly();
  }
}

function showSuccessScreen() {
  questionCard.classList.add("hidden");
  successCard.classList.remove("hidden");
}

function resetExperience() {
  hoverCount = 0;
  yesScale = 1;
  isFinalStage = false;

  yesBtn.style.transform = "scale(1)";
  noBtn.textContent = hoverMessages[0];
  subText.textContent = subTexts[0];
  mainGif.src = gifStates[0];

  questionCard.classList.remove("hidden");
  successCard.classList.add("hidden");

  if (window.innerWidth <= 480) {
    setButtonPosition(150, 54);
  } else if (window.innerWidth <= 768) {
    setButtonPosition(165, 45);
  } else {
    setButtonPosition(300, 56);
  }
}

noBtn.addEventListener("mouseenter", handleNoInteraction);
noBtn.addEventListener("click", handleNoInteraction);
buttonStage.addEventListener("mousemove", handleFinalNoMouseMove);
yesBtn.addEventListener("click", showSuccessScreen);
playAgainBtn.addEventListener("click", resetExperience);

window.addEventListener("resize", () => {
  if (!isFinalStage) {
    resetExperience();
  } else {
    moveNoButtonRandomly();
  }
});

resetExperience();