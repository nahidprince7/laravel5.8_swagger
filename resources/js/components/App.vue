<template>
    <div>

        <Header></Header>
        <div class="container-fluid">
            <div class="row">
                <Sidebar></Sidebar>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
                    <router-view>

                    </router-view>
                </main>
            </div>
        </div>
    </div>
</template>
<script>

export default {

}
</script>

<style scoped>

</style>
