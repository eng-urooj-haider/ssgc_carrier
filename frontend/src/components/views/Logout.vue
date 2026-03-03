<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../../axios.js'

const router = useRouter()

onMounted(async () => {
  try {
    await api.get('/logout') // call backend logout
    router.push('/login')     // redirect to login page
  } catch (error) {
    console.error('Logout failed:', error)
    router.push('/login')     // redirect anyway
  }
})
</script>