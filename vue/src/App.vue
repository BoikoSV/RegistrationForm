<script setup>
import FormComponent from './components/FormComponent.vue'
import {computed} from 'vue'

const fileUrl = computed(() => `${import.meta.env.VITE_SERVER_URL}/download-log`)
</script>

<template>
  <div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-6">
        <div class="card">
          <div>
            <div class="card-header">
              <ul class="nav nav-pills d-flex justify-content-end">
                <li class="nav-item">
                  <a class="nav-link" :href="fileUrl">Log file
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                      <path
                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                    </svg>
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-8">
                  <FormComponent />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.input-box {
  position: relative;
}

.valid-feedback,
.invalid-feedback {
  position: absolute;
  bottom: -20px;
}</style>