<script setup>
import { useField } from 'vee-validate'
import { computed } from 'vue'

const props = defineProps(['name', 'label', 'type', 'disabled'])

const { errorMessage, value, handleChange, meta } = useField(() => props.name, undefined, {
    validateOnValueUpdate: false,
});


const validationListeners = computed(() => {
    if (!errorMessage.value) {
        return {
            blur: handleChange,
            change: handleChange,
            input: e => handleChange(e, false),
        };
    }
    return {
        blur: handleChange,
        change: handleChange,
        input: handleChange,
    };
});


const id = Math.random()
</script>

<template>
    <div class="mb-4 input-box">
        <label :for="id" class="form-label">{{ props.label }}</label>
        <input 
            :disabled="disabled"
            :id="id"
            v-on="validationListeners" 
            :value="value" :class="['form-control', { 'is-invalid': errorMessage }, {'is-valid': meta.valid && meta.dirty}]"
            :type="type"
        >
        <div class="invalid-feedback">
            {{ errorMessage }}
        </div>
    </div>
</template>