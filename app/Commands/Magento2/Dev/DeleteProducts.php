<?php

namespace App\Commands\Magento2\Dev;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Services\Magento2;

class DeleteProducts extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'delete:products';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Delete all products in database by SQL commands';

    public function Magento2() {
        return new \App\Services\Magento2;
    }

    /**
     * Remove all products from Magento 2 database with SQL queries.
     *
     * @return mixed
     */
    public function handle()
    {

        if ($this->confirm('Warning: This function will remove all products from database. Do you want to continue?')) {

            $this->task("Delete all products with SQL queries", function () {

                $process = new Process(
                    [
                        'magerun2',
                        'db:query',
                        '
                        SET FOREIGN_KEY_CHECKS=0;
                        TRUNCATE TABLE `cataloginventory_stock_item`;
                        TRUNCATE TABLE `cataloginventory_stock_status`;
                        TRUNCATE TABLE `cataloginventory_stock_status_idx`;
                        TRUNCATE TABLE `cataloginventory_stock_status_tmp`;
                        TRUNCATE TABLE `catalog_category_product`;
                        TRUNCATE TABLE `catalog_category_product_index`;
                        TRUNCATE TABLE `catalog_category_product_index_tmp`;
                        TRUNCATE TABLE `catalog_compare_item`;
                        TRUNCATE TABLE `catalog_product_bundle_option`;
                        TRUNCATE TABLE `catalog_product_bundle_option_value`;
                        TRUNCATE TABLE `catalog_product_bundle_price_index`;
                        TRUNCATE TABLE `catalog_product_bundle_selection`;
                        TRUNCATE TABLE `catalog_product_bundle_selection_price`;
                        TRUNCATE TABLE `catalog_product_bundle_stock_index`;
                        TRUNCATE TABLE `catalog_product_entity`;
                        TRUNCATE TABLE `catalog_product_entity_datetime`;
                        TRUNCATE TABLE `catalog_product_entity_decimal`;
                        TRUNCATE TABLE `catalog_product_entity_gallery`;
                        TRUNCATE TABLE `catalog_product_entity_int`;
                        TRUNCATE TABLE `catalog_product_entity_media_gallery`;
                        TRUNCATE TABLE `catalog_product_entity_media_gallery_value`;
                        TRUNCATE TABLE `catalog_product_entity_media_gallery_value_to_entity`;
                        TRUNCATE TABLE `catalog_product_entity_media_gallery_value_video`;
                        TRUNCATE TABLE `catalog_product_entity_text`;
                        TRUNCATE TABLE `catalog_product_entity_tier_price`;
                        TRUNCATE TABLE `catalog_product_entity_varchar`;
                        TRUNCATE TABLE `catalog_product_index_eav`;
                        TRUNCATE TABLE `catalog_product_index_eav_decimal`;
                        TRUNCATE TABLE `catalog_product_index_eav_decimal_idx`;
                        TRUNCATE TABLE `catalog_product_index_eav_decimal_tmp`;
                        TRUNCATE TABLE `catalog_product_index_eav_idx`;
                        TRUNCATE TABLE `catalog_product_index_eav_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_opt_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_opt_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_sel_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_sel_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_bundle_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_cfg_opt_agr_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_cfg_opt_agr_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_cfg_opt_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_cfg_opt_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_downlod_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_downlod_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_final_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_final_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_opt_agr_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_opt_agr_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_opt_idx`;
                        TRUNCATE TABLE `catalog_product_index_price_opt_tmp`;
                        TRUNCATE TABLE `catalog_product_index_price_tmp`;
                        TRUNCATE TABLE `catalog_product_index_tier_price`;
                        TRUNCATE TABLE `catalog_product_index_website`;
                        TRUNCATE TABLE `catalog_product_link`;
                        TRUNCATE TABLE `catalog_product_link_attribute_decimal`;
                        TRUNCATE TABLE `catalog_product_link_attribute_int`;
                        TRUNCATE TABLE `catalog_product_link_attribute_varchar`;
                        TRUNCATE TABLE `catalog_product_option`;
                        TRUNCATE TABLE `catalog_product_option_price`;
                        TRUNCATE TABLE `catalog_product_option_title`;
                        TRUNCATE TABLE `catalog_product_option_type_price`;
                        TRUNCATE TABLE `catalog_product_option_type_title`;
                        TRUNCATE TABLE `catalog_product_option_type_value`;
                        TRUNCATE TABLE `catalog_product_relation`;
                        TRUNCATE TABLE `catalog_product_super_attribute`;
                        TRUNCATE TABLE `catalog_product_super_attribute_label`;
                        TRUNCATE TABLE `catalog_product_super_link`;
                        TRUNCATE TABLE `catalog_product_website`;
                        TRUNCATE TABLE `catalog_url_rewrite_product_category`;
                        TRUNCATE TABLE `downloadable_link`;
                        TRUNCATE TABLE `downloadable_link_price`;
                        TRUNCATE TABLE `downloadable_link_purchased`;
                        TRUNCATE TABLE `downloadable_link_purchased_item`;
                        TRUNCATE TABLE `downloadable_link_title`;
                        TRUNCATE TABLE `downloadable_sample`;
                        TRUNCATE TABLE `downloadable_sample_title`;
                        TRUNCATE TABLE `product_alert_price`;
                        TRUNCATE TABLE `product_alert_stock`;
                        TRUNCATE TABLE `report_compared_product_index`;
                        TRUNCATE TABLE `report_viewed_product_aggregated_daily`;
                        TRUNCATE TABLE `report_viewed_product_aggregated_monthly`;
                        TRUNCATE TABLE `report_viewed_product_aggregated_yearly`;
                        TRUNCATE TABLE `report_viewed_product_index`;
                        ALTER TABLE `cataloginventory_stock_item` AUTO_INCREMENT=1;
                        ALTER TABLE `cataloginventory_stock_status` AUTO_INCREMENT=1;
                        ALTER TABLE `cataloginventory_stock_status_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `cataloginventory_stock_status_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_category_product` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_category_product_index` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_category_product_index_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_compare_item` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_option` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_option_value` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_price_index` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_selection` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_selection_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_bundle_stock_index` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_datetime` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_decimal` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_gallery` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_int` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_media_gallery` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_media_gallery_value` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_media_gallery_value_to_entity` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_media_gallery_value_video` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_text` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_tier_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_entity_varchar` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav_decimal` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav_decimal_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav_decimal_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_eav_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_opt_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_opt_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_sel_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_sel_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_bundle_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_cfg_opt_agr_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_cfg_opt_agr_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_cfg_opt_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_cfg_opt_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_downlod_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_downlod_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_final_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_final_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_opt_agr_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_opt_agr_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_opt_idx` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_opt_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_price_tmp` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_tier_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_index_website` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_link` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_link_attribute_decimal` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_link_attribute_int` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_link_attribute_varchar` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option_title` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option_type_price` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option_type_title` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_option_type_value` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_relation` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_super_attribute` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_super_attribute_label` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_super_link` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_product_website` AUTO_INCREMENT=1;
                        ALTER TABLE `catalog_url_rewrite_product_category` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_link` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_link_price` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_link_purchased` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_link_purchased_item` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_link_title` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_sample` AUTO_INCREMENT=1;
                        ALTER TABLE `downloadable_sample_title` AUTO_INCREMENT=1;
                        ALTER TABLE `product_alert_price` AUTO_INCREMENT=1;
                        ALTER TABLE `product_alert_stock` AUTO_INCREMENT=1;
                        ALTER TABLE `report_compared_product_index` AUTO_INCREMENT=1;
                        ALTER TABLE `report_viewed_product_aggregated_daily` AUTO_INCREMENT=1;
                        ALTER TABLE `report_viewed_product_aggregated_monthly` AUTO_INCREMENT=1;
                        ALTER TABLE `report_viewed_product_aggregated_yearly` AUTO_INCREMENT=1;
                        ALTER TABLE `report_viewed_product_index` AUTO_INCREMENT=1;
                        SET FOREIGN_KEY_CHECKS=1;
                        '
                    ]
                );

                $process->run();

                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                return true;

            });
        };
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
