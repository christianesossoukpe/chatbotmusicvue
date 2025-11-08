<template>
  <div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4">
      <!-- En-tête -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
          🎵 Coach Musical Intelligent
        </h1>
        <p class="text-gray-600">
          Évaluez vos compétences et recevez des conseils personnalisés
        </p>
      </div>

      <!-- Étape 1: Sélection d'instrument -->
      <div v-if="etape === 'selection'" class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Bonjour ! Quel instrument pratiquez-vous ?</h2>
        <div class="grid grid-cols-2 gap-4">
          <button 
            v-for="instrument in instruments" 
            :key="instrument"
            @click="selectionnerInstrument(instrument)"
            class="p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors"
          >
            <span class="text-2xl mb-2 block">{{ getEmoji(instrument) }}</span>
            {{ instrument.charAt(0).toUpperCase() + instrument.slice(1) }}
          </button>
        </div>
      </div>

      <!-- Étape 2: Évaluation -->
      <div v-if="etape === 'evaluation'" class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
          <h2 class="text-xl font-semibold">Évaluation - {{ instrumentSelectionne }}</h2>
          <span class="text-sm text-gray-500">Question {{ questionActuelle + 1 }}/{{ questions.length }}</span>
        </div>

        <!-- Barre de progression -->
        <div class="w-full bg-gray-200 rounded-full h-2 mb-6">
          <div 
            class="bg-blue-600 h-2 rounded-full transition-all duration-300"
            :style="{ width: `${((questionActuelle + 1) / questions.length) * 100}%` }"
          ></div>
        </div>

        <!-- Question actuelle -->
        <div class="mb-6">
          <h3 class="text-lg font-medium mb-4">{{ questions[questionActuelle] }}</h3>
          <div class="space-y-2">
            <button 
              v-for="score in [1,2,3,4,5]" 
              :key="score"
              @click="repondre(score)"
              class="w-full p-3 text-left border rounded-lg hover:bg-gray-50 transition-colors"
            >
              {{ getLibelleReponse(score) }}
            </button>
          </div>
        </div>
      </div>

      <!-- Étape 3: Résultats -->
      <div v-if="etape === 'resultats'" class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-center mb-6">🎉 Résultats de votre évaluation</h2>
        
        <!-- Note -->
        <div class="text-center mb-6">
          <div class="text-5xl font-bold text-blue-600 mb-2">{{ resultats.note }}/20</div>
          <div class="text-lg text-gray-700">{{ resultats.evaluation }}</div>
        </div>

        <!-- Conseils -->
        <div class="border-t pt-6">
          <h3 class="text-xl font-semibold mb-4">💡 Conseils pour progresser</h3>
          <ul class="space-y-2">
            <li 
              v-for="(conseil, index) in resultats.conseils" 
              :key="index"
              class="flex items-start"
            >
              <span class="text-green-500 mr-2">✓</span>
              {{ conseil }}
            </li>
          </ul>
        </div>

        <button 
          @click="recommencer"
          class="w-full mt-6 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors"
        >
          Faire une nouvelle évaluation
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const etape = ref('selection')
const instrumentSelectionne = ref('')
const questions = ref([])
const questionActuelle = ref(0)
const reponses = ref([])

const resultats = reactive({
  note: 0,
  evaluation: '',
  conseils: []
})

const instruments = ['guitare', 'piano', 'chant', 'batterie', 'violon', 'saxophone']

function getEmoji(instrument) {
  const emojis = {
    guitare: '🎸',
    piano: '🎹', 
    chant: '🎤',
    batterie: '🥁',
    violon: '🎻',
    saxophone: '🎷'
  }
  return emojis[instrument] || '🎵'
}

async function selectionnerInstrument(instrument) {
  instrumentSelectionne.value = instrument
  etape.value = 'evaluation'
  
  try {
    const response = await fetch('/chatbot/demarrer', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ instrument })
    })
    
    const data = await response.json()
    questions.value = data.questions
  } catch (error) {
    console.error('Erreur:', error)
  }
}

function getLibelleReponse(score) {
  const libelles = {
    1: 'Pas du tout',
    2: 'Un peu',
    3: 'Moyennement', 
    4: 'Bien',
    5: 'Excellente maîtrise'
  }
  return libelles[score]
}

function repondre(score) {
  reponses.value.push({
    question: questions.value[questionActuelle.value],
    score: score
  })

  if (questionActuelle.value < questions.value.length - 1) {
    questionActuelle.value++
  } else {
    soumettreEvaluation()
  }
}

async function soumettreEvaluation() {
  try {
    const response = await fetch('/chatbot/evaluer', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        instrument: instrumentSelectionne.value,
        reponses: reponses.value
      })
    })
    
    const data = await response.json()
    resultats.note = data.note
    resultats.evaluation = data.evaluation
    resultats.conseils = data.conseils
    etape.value = 'resultats'
  } catch (error) {
    console.error('Erreur:', error)
  }
}

function recommencer() {
  etape.value = 'selection'
  instrumentSelectionne.value = ''
  questions.value = []
  questionActuelle.value = 0
  reponses.value = []
}
</script>

<style scoped>
/* Styles personnalisés supplémentaires si besoin */
</style>