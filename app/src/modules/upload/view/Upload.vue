<template>
  <div>
    <v-container>
      <h3>Upload CSV</h3>
    </v-container>

    <v-data-table>
      <template #top>
        <v-toolbar flat>
          <v-toolbar-title>Upload de Arquivos</v-toolbar-title>
          <v-divider inset class="ml-4" vertical />
          <v-spacer />

          <div class="d-flex">
            <v-file-input
              outlined
              dense
              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
              label="File input"
              style="min-width: 150px"
              v-model="arquivo"
              @change="teste"
            ></v-file-input>

            <v-btn class="mb-2 ml-2" outlined>Importar</v-btn>
          </div>
        </v-toolbar>
      </template>
    </v-data-table>
  </div>
</template>

<script>
export default {
  data: () => ({
    arquivo: null,
  }),
  methods: {
    async teste(e) {
      var form = "";
      form = new FormData();
      form.append("arquivo", this.arquivo);
      form.append("name", this.arquivo.name);

      console.log(form);
      console.log(e, this.arquivo);

      try {
        await this.$http.post("upload", form);
        this.$root.vtoast.show({
          message: 'Upload foi iniciado na fila dos uploads.',
          color: "success",
        });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style>
</style>