<template>
    <div>
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
                    <div class="flex justify-center">
                        <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-20">LOGIN</button>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script>
import { Form, Field, ErrorMessage } from 'vee-validate';

export default {
    components: {
        Form,
        Field,
        ErrorMessage
    },
    methods: {
        onSubmit(values) {
            console.log(values);
        }
    }
}
</script>