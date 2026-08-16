<?php

namespace Database\Seeders;

use App\Models\Ahsp;
use App\Models\AhspDetail;
use App\Models\Audit;
use App\Models\AuditDetail;
use App\Models\Building;
use App\Models\DataSet;
use App\Models\Equipment;
use App\Models\KnnResult;
use App\Models\Labor;
use App\Models\Material;
use App\Models\Rab;
use App\Models\RabDetail;
use App\Models\SupportCost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    private const TOTAL = 100;

    public function run(): void
    {
        $this->convertExistingDemoData();

        $user = User::query()->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Administrator Sistem',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        $buildings = $this->seedBuildings();
        $datasets = $this->seedDatasets();
        $materials = $this->seedMaterials();
        $labors = $this->seedLabors();
        $equipments = $this->seedEquipments();
        $supportCosts = $this->seedSupportCosts();
        $ahsps = $this->seedAhsps();

        foreach (range(1, self::TOTAL) as $index) {
            $building = $buildings[$index - 1];
            $dataset = $datasets[$index - 1];
            $audit = Audit::updateOrCreate(
                ['nomor_audit' => sprintf('CONTOH-AUD-%03d', $index)],
                [
                    'building_id' => $building->id,
                    'user_id' => $user->id,
                    'tanggal_audit' => Carbon::now()->subDays(self::TOTAL - $index),
                    'nilai_k' => 3,
                    'hasil_knn' => $dataset->kategori,
                    'catatan' => 'Data contoh untuk pengujian dashboard.',
                ]
            );

            AuditDetail::updateOrCreate(
                ['audit_id' => $audit->id, 'komponen' => 'Struktur'],
                ['nilai' => 70 + ($index % 31), 'keterangan' => 'Kondisi struktur data contoh.']
            );

            KnnResult::updateOrCreate(
                ['audit_id' => $audit->id, 'data_set_id' => $dataset->id],
                ['distance' => round(0.1 + (($index % 20) / 100), 4)]
            );

            $rab = Rab::updateOrCreate(
                ['nomor_rab' => sprintf('CONTOH-RAB-%03d', $index)],
                [
                    'audit_id' => $audit->id,
                    'tanggal_rab' => Carbon::now()->subDays(self::TOTAL - $index),
                    'total_biaya' => 0,
                ]
            );

            $ahsp = $ahsps[($index - 1) % count($ahsps)];
            $volume = 5 + ($index % 16);
            $subtotal = $volume * $ahsp->harga_satuan;
            RabDetail::updateOrCreate(
                ['rab_id' => $rab->id, 'ahsp_id' => $ahsp->id],
                [
                    'volume' => $volume,
                    'harga_satuan' => $ahsp->harga_satuan,
                    'subtotal' => $subtotal,
                ]
            );
            $rab->update(['total_biaya' => $rab->details()->sum('subtotal')]);
        }

        foreach (range(1, self::TOTAL) as $index) {
            $ahsp = $ahsps[$index - 1];
            $item = $materials[($index - 1) % count($materials)];
            AhspDetail::updateOrCreate(
                ['ahsp_id' => $ahsp->id, 'jenis' => 'material', 'item_id' => $item->id],
                ['koefisien' => round(0.1 + (($index % 10) / 10), 4)]
            );
        }
    }

    private function convertExistingDemoData(): void
    {
        User::where('email', 'admin.demo@example.com')->update([
            'name' => 'Administrator Sistem',
            'email' => 'admin@example.com',
        ]);

        Audit::where('nomor_audit', 'like', 'DEMO-%')->get()->each(function (Audit $item) {
            $item->update([
                'nomor_audit' => str_replace('DEMO-', 'CONTOH-', $item->nomor_audit),
                'catatan' => str_replace('demo', 'contoh', $item->catatan ?? ''),
            ]);
        });

        Rab::where('nomor_rab', 'like', 'DEMO-%')->get()->each(function (Rab $item) {
            $item->update(['nomor_rab' => str_replace('DEMO-', 'CONTOH-', $item->nomor_rab)]);
        });

        Building::where('kode_bangunan', 'like', 'DEMO-%')->get()->each(function (Building $item) {
            $item->update([
                'kode_bangunan' => str_replace('DEMO-', 'CONTOH-', $item->kode_bangunan),
                'nama_bangunan' => str_replace('Demo', 'Contoh', $item->nama_bangunan),
                'alamat' => str_replace('Demo', 'Contoh', $item->alamat),
            ]);
        });

        DataSet::where('kode_data', 'like', 'DEMO-%')->get()->each(function (DataSet $item) {
            $item->update([
                'kode_data' => str_replace('DEMO-', 'CONTOH-', $item->kode_data),
                'nama_bangunan' => str_replace('Demo', 'Contoh', $item->nama_bangunan),
                'keterangan' => str_replace('demo', 'contoh', $item->keterangan ?? ''),
            ]);
        });

        Material::where('kode', 'like', 'DEMO-%')->get()->each(function (Material $item) {
            $item->update([
                'kode' => str_replace('DEMO-', 'CONTOH-', $item->kode),
                'nama_bahan' => str_replace('Demo', 'Contoh', $item->nama_bahan),
                'keterangan' => str_replace('demo', 'contoh', $item->keterangan ?? ''),
            ]);
        });

        Labor::where('kode', 'like', 'DEMO-%')->get()->each(function (Labor $item) {
            $item->update([
                'kode' => str_replace('DEMO-', 'CONTOH-', $item->kode),
                'nama_pekerja' => str_replace('Demo', 'Contoh', $item->nama_pekerja),
            ]);
        });

        Equipment::where('kode', 'like', 'DEMO-%')->get()->each(function (Equipment $item) {
            $item->update([
                'kode' => str_replace('DEMO-', 'CONTOH-', $item->kode),
                'nama_alat' => str_replace('Demo', 'Contoh', $item->nama_alat),
            ]);
        });

        SupportCost::where('kode', 'like', 'DEMO-%')->get()->each(function (SupportCost $item) {
            $item->update([
                'kode' => str_replace('DEMO-', 'CONTOH-', $item->kode),
                'nama_biaya' => str_replace('Demo', 'Contoh', $item->nama_biaya),
                'keterangan' => str_replace('demo', 'contoh', $item->keterangan ?? ''),
            ]);
        });

        Ahsp::where('kode', 'like', 'DEMO-%')->get()->each(function (Ahsp $item) {
            $item->update([
                'kode' => str_replace('DEMO-', 'CONTOH-', $item->kode),
                'nama_pekerjaan' => str_replace('Demo', 'Contoh', $item->nama_pekerjaan),
            ]);
        });
    }

    private function seedBuildings(): array
    {
        $items = [];
        $types = ['Sekolah Dasar Negeri', 'Kantor Kecamatan', 'Puskesmas', 'Balai Desa'];
        $construction = ['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'];

        foreach (range(1, self::TOTAL) as $index) {
            $items[] = Building::updateOrCreate(
                ['kode_bangunan' => sprintf('CONTOH-BDG-%03d', $index)],
                [
                    'nama_bangunan' => $types[($index - 1) % count($types)] . ' ' . $index,
                    'jenis_bangunan' => $types[($index - 1) % count($types)],
                    'jenis_konstruksi' => $construction[($index - 1) % count($construction)],
                    'rayon' => 'Rayon ' . (($index - 1) % 10 + 1),
                    'alamat' => 'Jl. Pendidikan No. ' . $index,
                    'tahun_berdiri' => 2000 + ($index % 24),
                    'luas_bangunan' => 100 + ($index * 2.5),
                ]
            );
        }

        return $items;
    }

    private function seedDatasets(): array
    {
        $items = [];
        $types = ['Sekolah Dasar Negeri', 'Kantor Kecamatan', 'Puskesmas', 'Balai Desa'];
        $construction = ['Gedek', 'Semi Permanen', 'Permanen', 'Permanen Bertingkat'];
        $categories = ['Layak', 'Kurang Layak', 'Tidak Layak'];

        foreach (range(1, self::TOTAL) as $index) {
            $score = 50 + ($index % 51);
            $items[] = DataSet::updateOrCreate(
                ['kode_data' => sprintf('CONTOH-DATA-%03d', $index)],
                [
                    'nama_bangunan' => 'Gedung ' . $types[($index - 1) % count($types)] . ' ' . $index,
                    'jenis_konstruksi' => $construction[($index - 1) % count($construction)],
                    'pondasi' => $score, 'struktur' => min(100, $score + 3), 'atap' => min(100, $score + 5),
                    'dinding' => $score, 'lantai' => min(100, $score + 2), 'plafon' => $score,
                    'pintu' => min(100, $score + 1), 'jendela' => $score, 'listrik' => min(100, $score + 4),
                    'sanitasi' => $score, 'keterangan' => 'Dataset contoh.',
                    'kategori' => $categories[($index - 1) % count($categories)],
                ]
            );
        }

        return $items;
    }

    private function seedMaterials(): array
    {
        $items = [];
        foreach (range(1, self::TOTAL) as $index) {
            $materials = ['Semen Portland', 'Pasir Beton', 'Batu Split', 'Besi Beton 10 mm', 'Batu Bata Merah', 'Kayu Kaso'];
            $items[] = Material::updateOrCreate(
                ['kode' => sprintf('CONTOH-MAT-%03d', $index)],
                ['nama_bahan' => $materials[($index - 1) % count($materials)], 'satuan' => 'm3', 'harga_satuan' => 50000 + ($index * 2500), 'keterangan' => 'Bahan bangunan umum.']
            );
        }
        return $items;
    }

    private function seedLabors(): array
    {
        $items = [];
        foreach (range(1, self::TOTAL) as $index) {
            $labors = ['Tukang Batu', 'Tukang Kayu', 'Tukang Besi', 'Tukang Cat', 'Pekerja Bangunan', 'Mandor'];
            $items[] = Labor::updateOrCreate(
                ['kode' => sprintf('CONTOH-LAB-%03d', $index)],
                ['nama_pekerja' => $labors[($index - 1) % count($labors)], 'upah_harian' => 100000 + ($index * 5000)]
            );
        }
        return $items;
    }

    private function seedEquipments(): array
    {
        $items = [];
        foreach (range(1, self::TOTAL) as $index) {
            $equipment = ['Molen Beton', 'Mesin Pemadat Tanah', 'Gergaji Mesin', 'Bor Tangan', 'Pompa Air', 'Tangga Aluminium'];
            $items[] = Equipment::updateOrCreate(
                ['kode' => sprintf('CONTOH-EQP-%03d', $index)],
                ['nama_alat' => $equipment[($index - 1) % count($equipment)], 'satuan' => 'hari', 'harga_satuan' => 75000 + ($index * 3500)]
            );
        }
        return $items;
    }

    private function seedSupportCosts(): array
    {
        $items = [];
        $categories = ['Transportasi', 'Operasional', 'Lain-lain'];
        foreach (range(1, self::TOTAL) as $index) {
            $supportCosts = ['Transportasi Material', 'Konsumsi Pekerja', 'Pengangkutan Limbah', 'Biaya Administrasi'];
            $items[] = SupportCost::updateOrCreate(
                ['kode' => sprintf('CONTOH-SUP-%03d', $index)],
                ['nama_biaya' => $supportCosts[($index - 1) % count($supportCosts)], 'kategori' => $categories[($index - 1) % count($categories)], 'harga_satuan' => 25000 + ($index * 1500), 'keterangan' => 'Biaya operasional pekerjaan.']
            );
        }
        return $items;
    }

    private function seedAhsps(): array
    {
        $items = [];
        foreach (range(1, self::TOTAL) as $index) {
            $jobs = ['Pekerjaan Pondasi Batu Kali', 'Pekerjaan Beton Bertulang', 'Pemasangan Dinding Bata', 'Pekerjaan Plesteran', 'Pemasangan Keramik Lantai', 'Pengecatan Dinding'];
            $items[] = Ahsp::updateOrCreate(
                ['kode' => sprintf('CONTOH-AHSP-%03d', $index)],
                ['nama_pekerjaan' => $jobs[($index - 1) % count($jobs)], 'satuan' => 'm2', 'harga_satuan' => 150000 + ($index * 7500)]
            );
        }
        return $items;
    }
}
