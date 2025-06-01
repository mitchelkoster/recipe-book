<template>
    <div>
        <input class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-4 mb-4 w-full" type="text" name="tags" placeholder="Type a tag names and press 'Enter' after every tag" v-model="tagInput" @keyup.enter.prevent="addTag">


        <div class="text-center mb-4">
            <ul class="flex flex justify-start">
                <li v-for="(tag, index) in tags" class="py-0.5 px-2 mx-1 bg-green-200 text-green-800 rounded min-w-10">
                    {{ tag }}

                    <button type="button" @click="removeTag(index)">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 inline-flex items-center text-green-600 hover:text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75 14.25 12m0 0 2.25 2.25M14.25 12l2.25-2.25M14.25 12 12 14.25m-2.58 4.92-6.374-6.375a1.125 1.125 0 0 1 0-1.59L9.42 4.83c.21-.211.497-.33.795-.33H19.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25h-9.284c-.298 0-.585-.119-.795-.33Z" />
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['originalTags'],
    data() {
        return {
            tagInput: '',
            tags: []
        };
    },
    created() {
        this.tags = this.originalTags;
    },
    methods: {
        addTag() {
            if (this.tagInput.trim() !== '') {
                this.tags.push(this.tagInput.trim().toLowerCase());
                this.tagInput = '';
                this.$emit('tags-updated', this.tags.slice()); // Emitting the 'tags-updated' event with the updated tags array
            }
        },
        removeTag(index) {
            this.tags.splice(index, 1);
            this.$emit('tags-updated', this.tags.slice()); // Emitting the 'tags-updated' event with the updated tags array
        }
    },
    emits: ['tags-updated']
};
</script>
