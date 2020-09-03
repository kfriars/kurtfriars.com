<template>
    <div class="p-4 flex flex-col justify-center items-center mx-auto">
        <div class="bg-gray-300 h-64 w-full rounded-lg shadow-md bg-contain bg-center" :style="'background-image: url('+post.image+')'">
            <span class="bg-blue-400 px-2 py-1 rounded-md text-white text-xs font-bold float-right">Coming Soon</span>
        </div>
        <div class="bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
            <div class="title-post font-semibold text-gray-800 text-base mt-3 mb-1" v-text="post.title"></div>
            <div class="title-post text-xs mb-3 text-gray-800" v-text="post.created_at"></div>
            <div class="summary-post text-base text-justify mb-4 text-gray-700"> 
                <p 
                    v-for="(p, pid) in post.teaser"
                    :key="id+'-teaser-'+pid"
                    v-text="p"
                    class="mb-2 last:mb-0"
                ></p>
            </div>
            <div>
                <div
                    v-for="(tag, tid) in post.tags" 
                    :key="id+'-tag-'+tid"
                    class="header-content inline-flex ml-3 first:-ml-1"
                >
                    <div class="flex-1 h-4 w-4 m rounded-full m-1 bg-purple-100">
                        <div :class="['bg-'+tag.color+'-500']" class="h-2 w-2 rounded-full m-1" ></div>
                    </div>
                    <span class="category-title flex-1 text-sm" v-text="tag.label"></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'post-card',

    props: {
        id: {
            type: String,
            required: true,
        },
        post: {
            type: Object,
            required: true,
        }
    },

    data() {
        return {
            
        }
    }
}
</script>