<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Harga Berlaku" header-tag="h4" class="bg-primary-card">
                <router-link to="create" class="btn btn-primary pull-right create-btn"><i class="ti-plus"></i> TAMBAH</router-link>
                <div class="table-responsive">
                    <datatable title="DAFTAR HARGA BERLAKU" :rows="tableData" :columns="columndata"></datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vue from 'vue';
import datatable from "./plugins/DataTable/DataTable.vue";
export default {
    name: "pricelist",
    components: {
        datatable
    },
    data() {
        return {
            tableData: [],
            columndata: []
        }
    },
    mounted() {
        axios.get("/getColumns")
            .then(response => {
                this.columndata = response.data;
            })
            .catch(function(error) {});
        axios.get("/list")
            .then(response => {
                this.tableData = response.data;
            })
            .catch(function(error) {});
    }
}
</script>
<style>
    .create-btn{
        margin-bottom : 20px;
    }
    table > thead > tr > th{
        font-size: 13px;
    }
    table > tbody > tr > td{
        font-size: 13px;
    }
    .btn{
        font-size: 12px;
    }
</style>