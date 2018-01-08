<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card class="mb-2 bg-default-card" header="Tambah PDRB Harga Berlaku" header-tag="h4">
                <div>
                    <vue-form :state="formstate" @submit.prevent="onSubmit">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="hargaberlakuProvinceKode"> Provinsi</label>
                                        <select name="hargaberlakuProvinceKode" class="form-control" id="hargaberlakuProvinceKode" v-model="hargaberlakuProvinceKode" @change="getKota()" required checkbox>
                                            <option value="0" selected disabled>Pilih Provinsi</option>
                                            <option :value="province.provinsi_kode" v-for="province in provinces">
                                                {{ province.provinsi_nama }}
                                            </option>
                                        </select>
                                        <field-messages name="hargaberlakuProvinceKode" show="$invalid && $submitted" class="text-danger">
                                            <div slot="checkbox">Provinsi dibutuhkan.</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="hargaberlakuKotaKode"> Kota</label>
                                        <select name="hargaberlakuKotaKode" class="form-control" id="hargaberlakuKotaKode" v-model="hargaberlakuKotaKode" required checkbox>
                                            <option value="0" selected disabled>Pilih Kota</option>
                                            <option :value="city.kota_kode" v-for="city in cities">
                                                {{ city.kota_nama }}
                                            </option>
                                        </select>
                                        <field-messages name="hargaberlakuKotaKode" show="$invalid && $submitted" class="text-danger">
                                            <div slot="checkbox">Kota dibutuhkan.</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="hargaberlakuTgl"> Tanggal</label>
                                        <input type="date" name="hargaberlakuTgl" class="form-control input-sm" id="hargaberlakuTgl" value="yyyy-mm-dd" aria-selected="true" v-model="hargaberlakuTgl" required>
                                        <field-messages name="hargaberlakuTgl" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Tanggal dibutuhkan.</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="hargaberlakuValue"> Jumlah</label>
                                        <input type="number" name="hargaberlakuValue" class="form-control input-sm" id="hargaberlakuValue" placeholder="Masukkan Jumlah" v-model="hargaberlakuValue" required>
                                        <field-messages name="hargaberlakuValue" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Jumlah dibutuhkan.</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <b-button type="submit" size="md" variant="primary">
                                        <i class="ti-save"></i> Simpan
                                    </b-button>
                                    <router-link to="/" class="btn btn-danger"><i class="ti-arrow-left"></i> KEMBALI</router-link>
                                </div>
                            </div>
                        </div>
                    </vue-form>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
export default {
    name: "formfeatures",
    data() {
        return {
            provinces: [],
            cities: [],
            hargaberlakuProvinceKode: 0,
            hargaberlakuKotaKode: 0,
            hargaberlakuTgl: "",
            hargaberlakuValue: 0,
            formstate: {}
        }
    },
    methods: {
        onSubmit: function() {
            if (this.formstate.$invalid) {
                return;
            } else {
                axios.post('/create', {
                    hargaberlakuProvinceKode: this.hargaberlakuProvinceKode,
                    hargaberlakuKotaKode: this.hargaberlakuKotaKode,
                    hargaberlakuTgl: this.hargaberlakuTgl,
                    hargaberlakuValue: this.hargaberlakuValue
                })
                .then(response => {
                    this.$router.push({ name: 'list'})
                })
                .catch(function(error) {});
            }

        },
        getKota: function () {
            var val = this.hargaberlakuProvinceKode;
            axios.get("/getKota/"+val)
                .then(response => {
                    this.cities = response.data;
                })
                .catch(function(error) {});
        }
    },
    mounted: function() {
        axios.get("/getProvinsi")
            .then(response => {
                this.provinces = response.data;
            })
            .catch(function(error) {});
    },
    destroyed: function() {

    }
}
</script>