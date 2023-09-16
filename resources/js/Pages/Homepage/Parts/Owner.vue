<template>
    <section v-if="ownedAds.length" class="flex items-center justify-center mb-10 invisible lg:visible">
        <div v-if="ownedAds.length" class="w-1000 flex flex-col justify-center items-center bg-sand-800">

            <div class="w-full grid p-5">

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <h1 class="text-xl font-medium">{{ account }}</h1>
                    <p class="text-sm">Number of ads: {{ ownedAds.length }}</p>
                    <p class="text-sm">Contract: {{ chain.contract['1million'].address }}</p>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <select v-model="form.idx" @change="change" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:ring-tree-900 focus:border-transparent">
                        <option v-for="ad in ownedAds" :value="ad.idx">
                            {{ ad.title }}
                        </option>
                    </select>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold">Title</label>
                    <input type="text" v-model="form.title" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:ring-tree-900 focus:border-transparent" v-bind:class="[form.errors.title ? 'border-red-500' : 'border-tree-900']"/>
                    <div v-if="form.errors.title" class="text-red-500">
                        {{ form.errors.title }}
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold">Link</label>
                    <input type="url" v-model="form.link" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none focus:ring-2 focus:ring-tree-900 focus:border-transparent" v-bind:class="[form.errors.link ? 'border-red-500' : 'border-tree-900']"/>
                    <div v-if="form.errors.link" class="text-red-500">
                        {{ form.errors.link }}
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-5 mx-7">
                    <label class="uppercase md:text-sm text-xs text-tree-900 text-light font-semibold mb-1">Upload Photo</label>
                    <div v-bind:class="{ 'hidden': photoPreview}" class='flex items-center justify-center w-full'>
                        <label class='flex flex-col border-4 border-dashed  w-full h-32 hover:bg-sand-400 hover:border-tree-900 group' v-bind:class="[form.errors.photo ? 'border-red-500' : 'border-tree-900']">
                            <div class='flex flex-col items-center justify-center pt-7'>
                                <svg class="w-10 h-10 text-tree-900 group-hover:text-tree-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class='lowercase text-sm text-tree-900 group-hover:text-tree-900 pt-1 tracking-wider'>Select a photo</p>
                            </div>
                            <input type='file' class="hidden" ref="photo" @change="updatePhotoPreview"/>
                        </label>
                    </div>
                    <div v-if="photoPreview" class='flex items-center justify-center w-full'>
                        <div class="relative">
                            <button @click="deletePhoto" class="absolute top-0 right-0 p-4 w-4 h-4 rounded-50 bg-tree-900 text-white flex items-center justify-center">x</button>
                            <img class="h-40" :src="photoPreview">
                        </div>
                    </div>
                    <div v-if="!photoPreview" class='flex items-center justify-center w-full'>
                        <div class="relative">
                            <button @click="deletePhoto" class="absolute top-0 right-0 p-4 w-4 h-4 rounded-50 bg-tree-900 text-white flex items-center justify-center">x</button>
                            <img class="h-40" :src="form.photo">
                        </div>
                    </div>
                    <div v-if="form.errors.photo" class="text-red-500">
                        {{ form.errors.photo }}
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center bg-transparent">
                <button :disabled="form.processing" type="submit" class="bg-leaf-400 font-semibold text-white py-3 w-full rounded-b-md hover:bg-leaf-800 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300">
                    <span>Yes, Pixels everywhere !</span>
                </button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['chain', 'ownedAds'],
        methods: {
            change(e) {
                const idx = e.target.value
                this.form.title = this.ownedAds[idx].title
                this.form.link = this.ownedAds[idx].link
                this.form.photo = this.ownedAds[idx].image
                console.log(idx)
            }
        },
        data(){
            return {
                form: this.$inertia.form({
                    title: null,
                    link : null,
                    photo : null,
                }),
                photoPreview: null
            }
        }
    }
</script>
