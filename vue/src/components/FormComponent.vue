<script setup>
import InputComponent from './InputComponent.vue'
import axios from 'axios'
import { useForm } from 'vee-validate';
import * as yup from 'yup';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const schema = yup.object().shape({
  name: yup
    .string()
    .required('Ім\'я обов\'язкове')
    .min(5, 'Ім\'я повинно бути не менше 5 символів')
    .max(150, 'Ім\'я повинно бути не не більше 150 символів'),

  surname: yup
    .string()
    .required('Прізвище обов\'язкове')
    .min(5, 'Прізвище повинно бути не менше 5 символів')
    .max(150, 'Прізвище повинно бути не більше 150 символів'),

  email: yup
    .string()
    .email('Email обов\'язковий')
    .required('Ви маєте ввести дійстий Email'),

  password: yup
    .string()
    .required('Пароль обов\'язковий')
    .min(5, 'Пароль має буте не менше 5 символів')
    .max(100, 'Пароль не може бути довше 100 символів'),

    passwordConfirmation: yup
    .string()
    .oneOf([yup.ref('password'), null], 'Паролі мають співпадати')
    .required('Поле обов\'язкове для заповнення'),
});


const formValues = {
  name: '',
  surname: '',
  email: '',
  password: '',
  passwordConfirmation: ''
};

const { handleSubmit, isSubmitting } = useForm({
    validationSchema: schema,
    initialValues: formValues
});

const onSubmit = handleSubmit((values, { resetForm }) => {
    const data = {
        name: values.name,
        surname: values.surname,
        email: values.email,
        password: values.password,
        password_confirmation: values.passwordConfirmation
    }
    axios.post(`${import.meta.env.VITE_SERVER_URL}/users`, data).then(res => {
        toast.success(res.data.message);
        resetForm()
    }).catch(error => {
        toast.error(error.response.data.message);
    })
});
</script>

<template>
    <form @submit="onSubmit" class="mt-4 mb-4">
        <InputComponent :disabled="isSubmitting" name="name" label="Ім'я" type="text" />
        <InputComponent :disabled="isSubmitting" name="surname" label="Прізвище" type="text" />
        <InputComponent :disabled="isSubmitting" name="email" label="Email" type="text" />
        <InputComponent :disabled="isSubmitting" name="password" label="Пароль" type="password" />
        <InputComponent :disabled="isSubmitting" name="passwordConfirmation" label="Повторити пароль" type="password" />
        <div class="d-flex justify-content-end">
            <button :disabled="isSubmitting" type="submit" class="btn btn-success">Зареєструвати
                <div v-if="isSubmitting" class="spinner-border spinner-border-sm text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        </div>
    </form>
</template>