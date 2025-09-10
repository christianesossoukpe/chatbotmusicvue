<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
          <!-- <h1 class="text-2xl font-bold text-indigo-700">MusicBot Dashboard</h1> -->
          <form method="POST" action="/logout">
            <button 
              type="submit" 
              class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition duration-300"
            >
              Déconnexion
            </button>
          </form>
        </div>
      </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center space-x-8 py-4">
          <li 
            to="/chatbot" 
            class="text-gray-700 hover:text-indigo-600 font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center"
           >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            Chatbot
          </li>
          
          <li 
            to="/profile" 
            class="text-gray-700 hover:text-indigo-600 font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center"
           >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Mon Profil
          </li>
          
          <li 
            to="/analytics" 
            class="text-gray-700 hover:text-indigo-600 font-medium py-2 px-4 rounded-lg transition duration-300 flex items-center"
           >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Analytics
          </li>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6">Bienvenue sur votre tableau de bord 🎵</h1>
        <p class="text-gray-600 mb-8">Gérez votre expérience musicale et interagissez avec notre assistant intelligent.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
          <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-100">
            <div class="bg-indigo-100 p-3 rounded-full inline-flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-indigo-800 mb-2">Chatbot Musical</h3>
            <p class="text-gray-600 mb-4">Discutez avec notre assistant pour améliorer votre pratique musicale.</p>
            <li 
              to="/chatbot" 
              class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition duration-300"
            >
              Commencer
            </li>
          </div>
          
          <div class="bg-green-50 p-6 rounded-lg border border-green-100">
            <div class="bg-green-100 p-3 rounded-full inline-flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-green-800 mb-2">Votre Profil</h3>
            <p class="text-gray-600 mb-4">Consultez et modifiez vos informations personnelles et musicales.</p>
            <li 
              to="/profile" 
              class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition duration-300"
            >
              Voir le profil
            </li>
          </div>
          
          <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
            <div class="bg-purple-100 p-3 rounded-full inline-flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-purple-800 mb-2">Analytics</h3>
            <p class="text-gray-600 mb-4">Analysez vos progrès et obtenez des insights sur votre pratique musicale.</p>
            <li 
              to="/analytics" 
              class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded transition duration-300"
            >
              Voir les stats
            </li>
          </div>
        </div>
        
        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 text-left">
          <h2 class="text-xl font-semibold text-blue-800 mb-4">💡 Conseils du jour</h2>
          <p class="text-gray-700 mb-2">🎸 Pensez à accorder votre instrument avant chaque session de pratique.</p>
          <p class="text-gray-700 mb-2">🎵 Travaillez votre posture pour améliorer votre endurance lors des performances.</p>
          <p class="text-gray-700">📊 Consultez régulièrement vos analytics pour suivre vos progrès.</p>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
 const props = defineProps({
   user: Object
 });
</script>

<style scoped>
.li-active {
  background-color: #e0e7ff;
  color: #4338ca;
}
</style>