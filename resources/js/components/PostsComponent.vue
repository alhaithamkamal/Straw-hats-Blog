<template>
    <div>
        <h2>Posts</h2>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]"
                class="page-item"><a class="page-link" href="#"
                @click="fetchPosts(pagination.prev_page_url)">Previous</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]"
                class="page-item"><a class="page-link" href="#"
                @click="fetchPosts(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
        <div class="card card-body mb-2" v-for="post in posts" v-bind:key="post.id">
            <h3>{{ post.title }}</h3>
            <p>{{ post.body }}</p>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            posts: [],
            pagination: {}
        }
    },
    created() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts(page_url) {
            let vm = this;
            page_url = page_url || 'api/posts'
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
        },
        makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };
                this.pagination = pagination;
        }
    }
}
</script>

<style>

</style>
