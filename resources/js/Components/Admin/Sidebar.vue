<script setup>
import SidebarNavLink from "./SidebarNavLink.vue";
import SidebarNavLinkTitle from "./SidebarNavLinkTitle.vue";

</script>
<template>
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:top-0 md:mt-4 md:shadow-xl animated faster">
        <!-- sidebar content -->
    <div class="flex flex-col">

      <!-- sidebar toggle -->
      <div class="text-right hidden md:block mb-4">
        <button id="sideBarHideBtn">
          <i class="fad fa-times-circle"></i>
        </button>
      </div>
      <!-- end sidebar toggle -->
      <SidebarNavLinkTitle>Beranda</SidebarNavLinkTitle>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Dashboard
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Analitik
      </SidebarNavLink>

      <!-- operasional::start -->
      <SidebarNavLinkTitle>operasional</SidebarNavLinkTitle>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Pemesanan
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Transaksi
      </SidebarNavLink>
      <!-- operasional::end -->

      <!-- master::start -->
      <SidebarNavLinkTitle>master</SidebarNavLinkTitle>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Produk
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Varian Produk
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Grup Varian Produk
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Kategori Produk
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Status Order
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Status Order Item
      </SidebarNavLink>
      <!-- master::end -->

      <!-- customer::start -->
      <SidebarNavLinkTitle>pelanggan</SidebarNavLinkTitle>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Data Pelanggan
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Wawasan Pelanggan
      </SidebarNavLink>
      <!-- customer::end -->

      <!-- customer::start -->
      <SidebarNavLinkTitle>Tambahan</SidebarNavLinkTitle>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Pengaturan Akun
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Dokumentasi
      </SidebarNavLink>
      <SidebarNavLink :route="route('admin.dashboard')" icon="fad fa-shopping-cart text-xs mr-2">
        Keluar
      </SidebarNavLink>
      <!-- customer::end -->
    </div>
    <!-- end sidebar content -->

  </div>
</template>