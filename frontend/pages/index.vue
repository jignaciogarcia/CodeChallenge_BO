<template>
    <div class="bg-slate-100 w-screen h-screen">
        <header class="md:h-14 bg-fuchsia-100 block "></header>
        <div class="flex justify-center pt-28">
            <Form @submit="onSubmit">
                <div class="flex-col">
                    <h1 class="font-sans font-bold text-3xl text-center">Welcome</h1>
                    <div class="pt-6">
                        <label for="email" class="font-sans block">Add</label>
                        <Field type="email" name="email" id="email" placeholder="john@doe.com" rules="required|email"
                            class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96 block" />
                        <ErrorMessage name="email" as="div" class="bg-red-200 border-red-500 text-red-950 
                            p-1 m-1 rounded-md shadow-md text-center" />
                        <label for="password" class="font-sans block pt-2">Password</label>
                        <Field type="password" name="password" id="password" rules="required" 
                            class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96 block" />
                        <ErrorMessage name="password" as="div" class="bg-red-200 border-red-500 text-red-950 
                            p-1 m-1 rounded-md shadow-md text-center" />
                    </div>
                    <div class="flex flex-col items-center">
                        <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-20 active:bg-violet-700">
                            LOGIN
                        </button>
                        <CustomErrorCard id="errorText" hidden="true" />
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>


<script>
import { Form, Field, ErrorMessage } from 'vee-validate';
import { useAuthStore } from '@/stores/authStore';
import CustomErrorCard from '~/components/CustomErrorCard.vue';

export default {
    setup() {
        const authStore = useAuthStore();

        return { authStore }
    },
    components: {
    Form,
    Field,
    ErrorMessage,
    CustomErrorCard
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