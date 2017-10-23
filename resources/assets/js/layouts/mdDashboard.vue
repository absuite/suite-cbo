<template>
  <md-layout md-gutter md-column>
    <md-layout md-gutter md-row>
      <md-layout md-flex-small="100" md-flex="66">
        <md-card>
          <md-card-media>
            <md-chart class="myChart" ref="groupTrend"></md-chart>
          </md-card-media>
          <md-card-media>
            <md-layout>
              <md-layout md-flex="33" md-flex-xsmall="100">
                <md-chart ref="groupStructure"></md-chart>
              </md-layout>
              <md-layout md-flex="66" md-flex-xsmall="100">
                <md-chart ref="groupRank"></md-chart>
              </md-layout>
            </md-layout>
          </md-card-media>
        </md-card>
      </md-layout>
      <md-layout md-flex-small="100" md-flex="33">
        <md-card>
          <md-tabs md-fixed :md-dynamic-height="false" style="min-height:4rem" class="md-accent layout-fill">
            <md-tab md-label="资讯">
              <md-list class="custom-list md-triple-line">
                <md-list-item v-for="item in model.news" :key="item.id">
                  <div class="md-list-text-container">
                    <span>{{ item.title }}</span>
                    <p>{{ item.summary }}</p>
                  </div>
                  <md-button class="md-icon-button md-list-action">
                    <md-icon class="md-primary">star</md-icon>
                  </md-button>
                  <md-divider></md-divider>
                </md-list-item>
              </md-list>
            </md-tab>
            <md-tab md-label="法规">
              <md-list class="custom-list md-triple-line">
                <md-list-item v-for="item in model.statutes" :key="item.id">
                  <div class="md-list-text-container">
                    <span>{{ item.title }}</span>
                    <p>{{ item.summary }}</p>
                  </div>
                  <md-button class="md-icon-button md-list-action">
                    <md-icon class="md-primary">star</md-icon>
                  </md-button>
                  <md-divider></md-divider>
                </md-list-item>
              </md-list>
            </md-tab>
            <md-tab md-label="知识">
              <md-list class="custom-list md-triple-line">
                <md-list-item v-for="item in model.knowledges" :key="item.id">
                  <div class="md-list-text-container">
                    <span>{{ item.title }}</span>
                    <p>{{ item.summary }}</p>
                  </div>
                  <md-button class="md-icon-button md-list-action">
                    <md-icon class="md-primary">star</md-icon>
                  </md-button>
                  <md-divider></md-divider>
                </md-list-item>
              </md-list>
            </md-tab>
            <md-tab md-label="行情">
              <md-list class="md-dense">
                <md-list-item v-for="item in model.prices" :key="item.id">
                  <span>{{ item.title }}</span>
                  <span>{{ item.price }}</span>
                  <md-divider></md-divider>
                </md-list-item>
              </md-list>
            </md-tab>
          </md-tabs>
        </md-card>
      </md-layout>
    </md-layout>
  </md-layout>
</template>
<style scoped>
.md-card {
  margin: 0.15rem;
}

@media (max-width: 600px) {
  .md-card {
    margin: 0;
  }
}
</style>
<script>
import common from '../../gmf-sys/core/utils/common';

export default {
  props: {},
  data() {
    return {
      model: {
        purpose: this.$root.userConfig.purpose,
        fm_period: null,
        to_period: null,
        groups: [],
        prices: [],
        news: [],
        knowledges: [],
        statutes: []
      }
    };
  },
  watch: {
    'model.purpose': function(value) {
      this.loadData();
    },
    'model.fm_period': function(value) {
      this.loadData();
    },
    'model.to_period': function(value) {
      this.loadData();
    },
    'model.groups': function(value) {
      this.loadData();
    },
  },
  methods: {
    loadGroups() {
      this.$http.get('amiba/groups/all', { params: {} }).then(response => {
        this.model.groups = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('amiba/reports/period-info').then(response => {
        this.model.fm_period = response.data.data.yearFirstPeriod;
        this.model.to_period = response.data.data.period;
      });
    },
    loadBecInfo() {
      this.$http.get('bec/posts', { params: { type: "news", pageSize: 5 } }).then(response => {
        this.model.news = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/posts', { params: { type: "knowledge", pageSize: 5 } }).then(response => {
        this.model.knowledges = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/posts', { params: { type: "statute", pageSize: 5 } }).then(response => {
        this.model.statutes = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/prices', { params: { pageSize: 12 } }).then(response => {
        this.model.prices = response.data.data;
      }, response => {
        this.$toast(response);
      });
    },
    loadData() {
      this.loadGroupRank();
      if (this.model.groups && this.model.groups.length > 0) {
        this.loadTroupTrend();
      }
      if (this.model.to_period && this.model.groups && this.model.groups.length > 0) {
        this.loadGroupStructure(this.model.to_period.id, this.model.groups[0].id);
      }
    },
    loadGroupRank() {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ name: 'purpose_id', value: this.model.purpose.id });
      }
      if (this.model.fm_period) {
        queryCase.wheres.push({ name: 'period_id', value: this.model.fm_period.id });
      }
      this.$http.post('amiba/reports/group-rank-ans', queryCase).then(response => {
        this.updateGroupRank(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateGroupRank(data) {
      var datas = [];
      this._.each(data.data, (value, key) => {
        key < 10 && datas.push({
          name: value.name,
          y: value.this_profit
        });
      });

      var opts = {
        chart: {
          type: 'column',
          //spacing: [0, 0, 0, 0],
          height: '180px'
        },
        colors: ['#46BFBD'],
        title: {
          text: ''
        },
        xAxis: {
          type: 'category',
          crosshair: true,
          allowDecimals: false,
          labels: { y: 20 }
        },
        yAxis: {
          title: { text: '' },
          offset: -10,
          allowDecimals: false,
          tickAmount: 5,
          labels: { padding: 0 },
          lineWidth: 1,
          gridLineWidth: 0
        },
        tooltip: { enabled: true, shared: true },
        plotOptions: {
          column: {
            groupPadding: 0.1,
            borderWidth: 0,
            dataLabels: { enabled: false },
          }
        },
        legend: { enabled: false },
        series: [{
          name: '利润',
          data: datas
        }]
      };
      this.$refs.groupRank.mergeOption(opts);
    },
    loadGroupStructure(group_id, period_id) {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ name: 'purpose_id', value: this.model.purpose.id });
      }
      if (period_id) {
        queryCase.wheres.push({ name: 'period_id', value: period_id });
      }
      if (group_id) {
        queryCase.wheres.push({ name: 'group_id', value: group_id });
      }
      this.$http.post('amiba/reports/group-structure-ans', queryCase).then(response => {
        this.updateGroupStructure(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateGroupStructure(data) {
      var opts = {
        chart: {
          type: 'pie',
          spacing: [0, 0, 0, 0],
          margin: [0, 0, 0, 0],
          height: '180px'
        },
        title: { text: '', floating: true, align: 'center', verticalAlign: 'middle', },
        colors: ['#F7464A', '#46BFBD', '#FDB45C'],
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderWidth: 0,
            innerSize: '60%',
            shadow: false,
            center: ['50%', '50%'],
            dataLabels: {
              enabled: false
            },
            showInLegend: true,
            point: {
              events: {
                click(e) {
                  this.series.chart.setTitle({ text: this.name + '<br/>' + Math.round(this.percentage * 10) / 10 + '%' });
                }
              }
            },
          }
        },
        tooltip: { enabled: false },
        legend: {
          enabled: true,
          symbolRadius: 3,
          align: 'left',
          verticalAlign: 'middle',
          //floating: true,
          layout: "vertical"
        },
        series: [{
          type: 'pie',
          data: [
            { name: '收入', y: 20 },
            { name: '成本', y: 15 },
            { name: '利润', y: 5 },
          ]
        }]
      };
      this.$refs.groupStructure.mergeOption(opts);
    },
    loadTroupTrend(group_id) {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ name: 'purpose_id', value: this.model.purpose.id });
      }
      if (this.model.fm_period) {
        queryCase.wheres.push({ name: 'fm_period', operator: 'greater_than_equal', value: this.model.fm_period.code });
      }
      if (this.model.to_period) {
        queryCase.wheres.push({ name: 'to_period', operator: 'less_than_equal', value: this.model.to_period.code });
      }
      if (group_id) {
        queryCase.wheres.push({ name: 'group_id', value: group_id });
      }
      this.$http.post('amiba/reports/group-trend-ans', queryCase).then(response => {
        this.updateTroupTrend(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateTroupTrend(data) {
      if (!data || !data.group || !data.data) return;
      var categories = [];
      var datas1 = [];
      var datas2 = [];
      var datas3 = [];

      this._.each(data.data, (value, key) => {
        categories.push(value.name);
        datas1.push({
          name: value.name,
          y: value.this_profit
        });
        datas2.push({
          name: value.name,
          y: value.this_income
        });
        datas3.push({
          name: value.name,
          y: value.this_cost
        });
      });

      var opts = {
        chart: {
          type: 'areaspline',
          backgroundColor: "#00acc1",
        },
        title: {
          text: data.group.name + '趋势',
          align: 'left',
          style: { "color": "rgba(255,255,255,0.8)" }
        },
        colors: ['#27bbce', '#5dd0df'],
        legend: { enabled: false },
        xAxis: {
          title: {
            text: '',
          },
          type: 'category',
          labels: {
            style: { "color": "rgba(255,255,255,0.6)" }
          },
        },
        yAxis: {
          title: {
            text: '',
          },
          lineWidth: 1,
          lineColor: 'rgba(255,255,255,0.3)',
          tickAmount: 15,
          gridLineColor: 'rgba(255,255,255,0.3)',
          labels: {
            style: { "color": "rgba(255,255,255,0.6)" },
            formatter: function() {
              return this.value;
            }
          }
        },
        tooltip: {
          formatter: function() {
            return '<b>' + this.series.name + '</b><br/>' +
              this.x + ': ' + this.y;
          }
        },
        plotOptions: {
          areaspline: {
            marker: {
              lineWidth: 2,
              symbol: 'circle',
              radius: 3,
            },
            pointPlacement: 'on',
          }
        },
        series: [{
            name: '利润',
            data: datas1
          },
          // {
          //   name: '收入',
          //   data: datas2
          // }, {
          //   name: '成本',
          //   data: datas3
          // }
        ]
      }
      this.$refs.groupTrend.mergeOption(opts);
    },
  },
  created() {

  },
  mounted() {
    this.loadGroups();
    this.loadBecInfo();
    this.loadData();
  },
};
</script>