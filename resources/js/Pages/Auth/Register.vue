<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    cpf: '',
    telefone: '',
    dob: '',
    cep: '',
    logradouro: '',
    complemento: '',
    bairro: '',
    localidade: '',
    uf: '',
    role: '', // Adicionando o campo role
});

const fetchAddress = async () => {
    if (form.cep.length === 8) {
        try {
            const response = await axios.get(`https://viacep.com.br/ws/${form.cep}/json/`);
            if (!response.data.erro) {
                form.logradouro = response.data.logradouro;
                form.complemento = response.data.complemento;
                form.bairro = response.data.bairro;
                form.localidade = response.data.localidade;
                form.uf = response.data.uf;
            } else {
                alert('CEP não encontrado.');
            }
        } catch (error) {
            console.error('Erro ao buscar o CEP:', error);
            alert('Erro ao buscar o CEP.');
        }
    }
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4">
                <InputLabel for="cpf" value="CPF" />
                <TextInput
                    id="cpf"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cpf"
                    required
                    autocomplete="cpf"
                />
                <InputError class="mt-2" :message="form.errors.cpf" />
            </div>

            <div class="mt-4">
                <InputLabel for="telefone" value="Telefone" />
                <TextInput
                    id="telefone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.telefone"
                    required
                    autocomplete="telefone"
                />
                <InputError class="mt-2" :message="form.errors.telefone" />
            </div>

            <div class="mt-4">
                <InputLabel for="dob" value="Data de Nascimento" />
                <TextInput
                    id="dob"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.dob"
                    required
                    autocomplete="dob"
                />
                <InputError class="mt-2" :message="form.errors.dob" />
            </div>

            <div class="mt-4">
                <InputLabel for="cep" value="CEP" />
                <TextInput
                    id="cep"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cep"
                    @blur="fetchAddress"
                    required
                    autocomplete="cep"
                />
                <InputError class="mt-2" :message="form.errors.cep" />
            </div>

            <div class="mt-4">
                <InputLabel for="logradouro" value="Logradouro" />
                <TextInput
                    id="logradouro"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.logradouro"
                    required
                    autocomplete="logradouro"
                />
                <InputError class="mt-2" :message="form.errors.logradouro" />
            </div>

            <div class="mt-4">
                <InputLabel for="complemento" value="Complemento" />
                <TextInput
                    id="complemento"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.complemento"
                    autocomplete="complemento"
                />
                <InputError class="mt-2" :message="form.errors.complemento" />
            </div>

            <div class="mt-4">
                <InputLabel for="bairro" value="Bairro" />
                <TextInput
                    id="bairro"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.bairro"
                    required
                    autocomplete="bairro"
                />
                <InputError class="mt-2" :message="form.errors.bairro" />
            </div>

            <div class="mt-4">
                <InputLabel for="localidade" value="Localidade" />
                <TextInput
                    id="localidade"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.localidade"
                    required
                    autocomplete="localidade"
                />
                <InputError class="mt-2" :message="form.errors.localidade" />
            </div>

            <div class="mt-4">
                <InputLabel for="uf" value="UF" />
                <TextInput
                    id="uf"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.uf"
                    required
                    autocomplete="uf"
                />
                <InputError class="mt-2" :message="form.errors.uf" />
            </div>

            <div class="mt-4">
                <InputLabel for="role" value="Role" />
                <select
                    id="role"
                    class="mt-1 block w-full"
                    v-model="form.role"
                    required
                >
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="psicologo">Psicologo</option>
                    <option value="secretaria">Secretaria</option>
                </select>
                <InputError class="mt-2" :message="form.errors.role" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
