<template>
    <div>
        <header class="md:h-14 bg-fuchsia-100 block "></header>
        <div class="flex justify-center pt-28">
            <div class="flex-col">
                <h1 class="font-sans font-bold text-3xl text-center">Welcome</h1>
                <div class="pt-6">
                    <label for="email" class="font-sans block">Add</label>
                    <input type="text" id="email" placeholder="john@doe.com" 
                    class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96"/>
                    <label for="password" class="font-sans block pt-2">Password</label>
                    <input type="password" id="password"  
                    class="bg-fuchsia-100 h-10 px-4 rounded w-75 md:w-96"/>
                </div>
                <div class="flex justify-center">
                    <button class="bg-violet-500 text-white rounded-3xl mt-7 py-2.5 px-20">LOGIN</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>