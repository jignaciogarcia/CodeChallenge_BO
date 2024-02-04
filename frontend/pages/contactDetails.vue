<template>
    <div class="bg-slate-100 h-screen w-screen">
        <header class="md:h-14 bg-fuchsia-100 block">
            <div class="flex">
                <button>&lt Back</button>
            </div>
        </header>
        <div class="pt-10 px-14">
            <div class="bg-gray-300 h-48 w-full rounded-xl flex justify-end items-end">
                <button
                    class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-8 active:bg-violet-700 mr-5 mb-5">EDIT</button>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <div class="relative bottom-24 flex flex-col items-center">
                <img src="https://cdn2.iconfinder.com/data/icons/smiles-business/512/1041_boy_c-512.png"
                    class="rounded-full h-40 w-40 border-2 border-black">
                <p class="font-sans font-bold text-lg mt-8">CONTACT NAME</p>
                <p class="text-slate-500">Title?</p>
                <div class="grid grid-cols-2 gap-x-10 gap-y-5 mt-12">
                    <div>
                        <p class="font-bold font-sans mb-2">Address</p>
                        <p class="text-slate-500">Bulevar Artigas 1010</p>
                    </div>
                    <div>
                        <p class="font-bold font-sans mb-2">Email</p>
                        <p class="text-slate-500">AAA@mail.com</p>
                    </div>
                    <div>
                        <p class="font-bold font-sans mb-2">Phone</p>
                        <p class="text-slate-500">09999999</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const { contact } = defineProps(['contact']);
</script>