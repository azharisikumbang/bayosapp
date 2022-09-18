<script setup>
import AdminSidebar from '@/Components/Admin/Sidebar.vue';
import AdminTopNavbar from '@/Components/Admin/TopNavbar.vue';
</script>

<template>
    <div>
        <AdminTopNavbar></AdminTopNavbar>
        <div class="h-screen flex flex-row flex-wrap">
            <AdminSidebar></AdminSidebar>
            <!-- Page Content -->
            <div class="bg-gray-100 flex-1 p-6 md:mt-16">
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>