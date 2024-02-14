<template>
    <div class="bg-slate-100 w-full h-screen">
        <header class="md:h-14 bg-fuchsia-100 block "></header>
        <div class="flex justify-center pt-28">
            <Form @submit="onSubmit">
                <div class="flex-col">
                    <h1 class="font-sans font-bold text-3xl text-center">Welcome</h1>
                    <div class="pt-6">
                        <label for="email" class="font-sans block">Add</label>
                        <Field type="email" name="email" id="email" placeholder="john@doe.com" rules="required|email"
                            class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96 block" />
                        <ErrorMessage name="email" as="div" class="errorMessage" />
                        <label for="password" class="font-sans block pt-2">Password</label>
                        <Field type="password" name="password" id="password" rules="required" 
                            class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96 block" />
                        <ErrorMessage name="password" as="div" class="errorMessage" />
                    </div>
                    <div class="flex flex-col items-center">
                        <button class="button px-20 mt-7">
                            LOGIN
                        </button>
                        <p id="errorText" hidden="true" class="errorMessage"></p>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>


<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import { useAuthStore } from '@/stores/authStore';

export default {
    setup() {
        const authStore = useAuthStore();

        return { authStore }
    },
    components: {
    Form,
    Field,
    ErrorMessage
},
    methods: {
        async onSubmit(values) {
            let errorText = document.getElementById('errorText');

            try{
                errorText.hidden = true;
                await this.authStore.login(values.email, values.password);
                navigateTo('/contacts');
            }
            catch(error) {
                errorText.hidden = false;
                errorText.innerText = error.message;
            }
        }
    }
}
</script>