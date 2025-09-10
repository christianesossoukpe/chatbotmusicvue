<script setup>
import { ref, onMounted } from 'vue'

// Base de données de questions
const questions = [
  "Comment décrirais-tu ta manière de jouer de ton instrument ?",
  "Qu'est-ce qui te rend unique quand tu chantes ?",
  "As-tu déjà eu des difficultés à reproduire un chant à l'oreille ?",
  "Quelle est ta posture idéale sur scène ?",
  "Comment vis-tu le ministère musical dans ta vie ?",
  "Comment entretiens-tu ton instrument chaque semaine ?",
  "Quelle est la première chose que tu vérifies avant un concert ?",
  "Quelle note musicale t'inspire le plus et pourquoi ?",
  "Connais-tu les intervalles de base comme la tierce ou la quinte ?",
  "Quel est ton rituel avant de monter sur scène ?"
]

// Réponses aléatoires (tu peux les enrichir)
const randomResponses = [
  "C’est une belle approche ! Continue à écouter ton cœur.",
  "Intéressant ! La posture influence beaucoup l’énergie sur scène.",
  "L’oreille musicale s’entraîne comme un muscle, bravo d’y travailler.",
  "Le ministère musical, c’est d’abord une attitude du cœur.",
  "Prendre soin de son instrument, c’est respecter l’art.",
  "La théorie, c’est le fondement de la liberté en musique.",
  "Chaque musicien a son rythme… le tien est précieux.",
  "Tu as raison de porter attention à ces détails.",
  "C’est beau de voir ta passion à travers ces mots.",
  "Continue à explorer, tu es sur la bonne voie."
]

const messages = ref([
  { type: 'bot', text: 'Salut musicien 🎶 ! Je suis ici pour échanger avec toi. Prêt à répondre à une question ?' }
])
const userInput = ref('')
const showInput = ref(false)

// Fonction pour poser une question aléatoire
const askRandomQuestion = () => {
  const randomQ = questions[Math.floor(Math.random() * questions.length)]
  messages.value.push({ type: 'bot', text: randomQ })
  showInput.value = true
}

// Démarrer avec une question
onMounted(() => {
  setTimeout(askRandomQuestion, 1000)
})

// Envoyer une réponse utilisateur
const sendMessage = () => {
  if (!userInput.value.trim()) return

  messages.value.push({ type: 'user', text: userInput.value })
  userInput.value = ''

  // Réponse aléatoire du bot après 1s
  setTimeout(() => {
    const response = randomResponses[Math.floor(Math.random() * randomResponses.length)]
    messages.value.push({ type: 'bot', text: response })
    setTimeout(askRandomQuestion, 1500) // Nouvelle question après réponse
  }, 1000)
}
</script>

<template>
  <div class="chat-container">
    <div class="messages">
      <div v-for="(msg, index) in messages" :key="index" :class="['message', msg.type]">
        {{ msg.text }}
      </div>
    </div>

    <div v-if="showInput" class="input-area">
      <input
        v-model="userInput"
        @keyup.enter="sendMessage"
        placeholder="Écris ta réponse..."
        type="text"
      />
      <button @click="sendMessage">Envoyer</button>
    </div>
  </div>
</template>

<style scoped>
.chat-container {
  max-width: 480px;
  margin: 0 auto;
  height: 100vh;
  display: flex;
  flex-direction: column;
  background: #f9f9fb;
  font-family: 'Segoe UI', sans-serif;
}

.messages {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.message {
  padding: 12px 16px;
  border-radius: 18px;
  max-width: 80%;
  line-height: 1.4;
}

.message.user {
  align-self: flex-end;
  background: #6d63ff;
  color: white;
  box-shadow: 0 1px 3px rgba(109, 99, 255, 0.3);
}

.message.bot {
  align-self: flex-start;
  background: #e8e6f4;
  color: #333;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.input-area {
  display: flex;
  padding: 12px;
  background: white;
  border-top: 1px solid #eee;
  gap: 8px;
}

.input-area input {
  flex: 1;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 24px;
  outline: none;
  font-size: 14px;
}

.input-area button {
  background: #6d63ff;
  color: white;
  border: none;
  padding: 0 16px;
  border-radius: 24px;
  cursor: pointer;
  font-weight: 600;
}

/* Mobile-only (si tu veux bloquer desktop) */
@media (min-width: 768px) {
  .chat-container::before {
    content: "Ce chatbot est accessible uniquement sur mobile.";
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #888;
    font-size: 18px;
    text-align: center;
    padding: 20px;
  }
}
</style>
