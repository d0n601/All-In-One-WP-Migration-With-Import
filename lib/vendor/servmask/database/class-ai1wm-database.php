<?php
/**
 * Copyright (C) 2014-2018 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

abstract class Ai1wm_Database {

	/**
	 * Number of queries per transaction
	 *
	 * @var integer
	 */
	const QUERIES_PER_TRANSACTION = 1000;

	/**
	 * WordPress database handler
	 *
	 * @var object
	 */
	protected $wpdb = null;

	/**
	 * Old table prefixes
	 *
	 * @var array
	 */
	protected $old_table_prefixes = array();

	/**
	 * New table prefixes
	 *
	 * @var array
	 */
	protected $new_table_prefixes = array();

	/**
	 * Old column prefixes
	 *
	 * @var array
	 */
	protected $old_column_prefixes = array();

	/**
	 * New column prefixes
	 *
	 * @var array
	 */
	protected $new_column_prefixes = array();

	/**
	 * Old replace values
	 *
	 * @var array
	 */
	protected $old_replace_values = array();

	/**
	 * New replace values
	 *
	 * @var array
	 */
	protected $new_replace_values = array();

	/**
	 * Table where clauses
	 *
	 * @var array
	 */
	protected $table_where_clauses = array();

	/**
	 * Table prefix columns
	 *
	 * @var array
	 */
	protected $table_prefix_columns = array();

	/**
	 * Include table prefixes
	 *
	 * @var array
	 */
	protected $include_table_prefixes = array();

	/**
	 * Exclude table prefixes
	 *
	 * @var array
	 */
	protected $exclude_table_prefixes = array();

	/**
	 * List all tables that should not be affected by the timeout of the current request
	 *
	 * @var array
	 */
	protected $atomic_tables = array();

	/**
	 * Visual Composer
	 *
	 * @var boolean
	 */
	protected $visual_composer = false;

	/**
	 * BeTheme Responsive
	 *
	 * @var boolean
	 */
	protected $betheme_responsive = false;

	/**
	 * Constructor
	 *
	 * @param object $wpdb WPDB instance
	 */
	public function __construct( $wpdb ) {
		$this->wpdb = $wpdb;

		// Check Microsoft SQL Server support
		if ( is_resource( $this->wpdb->dbh ) ) {
			if ( get_resource_type( $this->wpdb->dbh ) === 'SQL Server Connection' ) {
				throw new Exception(
					'Your WordPress installation uses Microsoft SQL Server. ' .
					'In order to use All in One WP Migration, please change your installation to MySQL and try again. ' .
					'<a href="https://help.servmask.com/knowledgebase/microsoft-sql-server/" target="_blank">Technical details</a>'
				);
			}
		}

		// Set database host (HyberDB)
		if ( empty( $this->wpdb->dbhost ) ) {
			if ( isset( $this->wpdb->last_used_server['host'] ) ) {
				$this->wpdb->dbhost = $this->wpdb->last_used_server['host'];
			}
		}

		// Set database name (HyperDB)
		if ( empty( $this->wpdb->dbname ) ) {
			if ( isset( $this->wpdb->last_used_server['name'] ) ) {
				$this->wpdb->dbname = $this->wpdb->last_used_server['name'];
			}
		}
	}

	/**
	 * Set old table prefixes
	 *
	 * @param  array  $prefixes List of table prefixes
	 * @return object
	 */
	public function set_old_table_prefixes( $prefixes ) {
		$this->old_table_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get old table prefixes
	 *
	 * @return array
	 */
	public function get_old_table_prefixes() {
		return $this->old_table_prefixes;
	}

	/**
	 * Set new table prefixes
	 *
	 * @param  array  $prefixes List of table prefixes
	 * @return object
	 */
	public function set_new_table_prefixes( $prefixes ) {
		$this->new_table_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get new table prefixes
	 *
	 * @return array
	 */
	public function get_new_table_prefixes() {
		return $this->new_table_prefixes;
	}

	/**
	 * Set old column prefixes
	 *
	 * @param  array  $prefixes List of column prefixes
	 * @return object
	 */
	public function set_old_column_prefixes( $prefixes ) {
		$this->old_column_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get old column prefixes
	 *
	 * @return array
	 */
	public function get_old_column_prefixes() {
		return $this->old_column_prefixes;
	}

	/**
	 * Set new column prefixes
	 *
	 * @param  array  $prefixes List of column prefixes
	 * @return object
	 */
	public function set_new_column_prefixes( $prefixes ) {
		$this->new_column_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get new column prefixes
	 *
	 * @return array
	 */
	public function get_new_column_prefixes() {
		return $this->new_column_prefixes;
	}

	/**
	 * Set old replace values
	 *
	 * @param  array  $values List of values
	 * @return object
	 */
	public function set_old_replace_values( $values ) {
		$this->old_replace_values = $values;

		return $this;
	}

	/**
	 * Get old replace values
	 *
	 * @return array
	 */
	public function get_old_replace_values() {
		return $this->old_replace_values;
	}

	/**
	 * Set new replace values
	 *
	 * @param  array  $values List of values
	 * @return object
	 */
	public function set_new_replace_values( $values ) {
		$this->new_replace_values = $values;

		return $this;
	}

	/**
	 * Get new replace values
	 *
	 * @return array
	 */
	public function get_new_replace_values() {
		return $this->new_replace_values;
	}

	/**
	 * Set old replace raw values
	 *
	 * @param  array  $values List of values
	 * @return object
	 */
	public function set_old_replace_raw_values( $values ) {
		$this->old_replace_raw_values = $values;

		return $this;
	}

	/**
	 * Get old replace raw values
	 *
	 * @return array
	 */
	public function get_old_replace_raw_values() {
		return $this->old_replace_raw_values;
	}

	/**
	 * Set new replace raw values
	 *
	 * @param  array  $values List of values
	 * @return object
	 */
	public function set_new_replace_raw_values( $values ) {
		$this->new_replace_raw_values = $values;

		return $this;
	}

	/**
	 * Get new replace raw values
	 *
	 * @return array
	 */
	public function get_new_replace_raw_values() {
		return $this->new_replace_raw_values;
	}

	/**
	 * Set table where clauses
	 *
	 * @param  string $table   Table name
	 * @param  array  $clauses Table clauses
	 * @return object
	 */
	public function set_table_where_clauses( $table, $clauses ) {
		$this->table_where_clauses[ strtolower( $table ) ] = $clauses;

		return $this;
	}

	/**
	 * Get table where clauses
	 *
	 * @param  string $table Table name
	 * @return array
	 */
	public function get_table_where_clauses( $table ) {
		if ( isset( $this->table_where_clauses[ strtolower( $table ) ] ) ) {
			return $this->table_where_clauses[ strtolower( $table ) ];
		}

		return array();
	}

	/**
	 * Set table prefix columns
	 *
	 * @param  string $table   Table name
	 * @param  array  $columns Table columns
	 * @return object
	 */
	public function set_table_prefix_columns( $table, $columns ) {
		foreach ( $columns as $column ) {
			$this->table_prefix_columns[ strtolower( $table ) ][ strtolower( $column ) ] = true;
		}

		return $this;
	}

	/**
	 * Get table prefix columns
	 *
	 * @param  string $table Table name
	 * @return array
	 */
	public function get_table_prefix_columns( $table ) {
		if ( isset( $this->table_prefix_columns[ strtolower( $table ) ] ) ) {
			return $this->table_prefix_columns[ strtolower( $table ) ];
		}

		return array();
	}

	/**
	 * Set include table prefixes
	 *
	 * @param  array  $prefixes List of table prefixes
	 * @return object
	 */
	public function set_include_table_prefixes( $prefixes ) {
		$this->include_table_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get include table prefixes
	 *
	 * @return array
	 */
	public function get_include_table_prefixes() {
		return $this->include_table_prefixes;
	}

	/**
	 * Set exclude table prefixes
	 *
	 * @param  array  $prefixes List of table prefixes
	 * @return object
	 */
	public function set_exclude_table_prefixes( $prefixes ) {
		$this->exclude_table_prefixes = $prefixes;

		return $this;
	}

	/**
	 * Get exclude table prefixes
	 *
	 * @return array
	 */
	public function get_exclude_table_prefixes() {
		return $this->exclude_table_prefixes;
	}

	/**
	 * Set atomic tables
	 *
	 * @param  array  $tables List of tables
	 * @return object
	 */
	public function set_atomic_tables( $tables ) {
		$this->atomic_tables = $tables;

		return $this;
	}

	/**
	 * Get atomic tables
	 *
	 * @return array
	 */
	public function get_atomic_tables() {
		return $this->atomic_tables;
	}

	/**
	 * Set Visual Composer
	 *
	 * @param  boolean $active Is Visual Composer Active?
	 * @return object
	 */
	public function set_visual_composer( $active ) {
		$this->visual_composer = $active;

		return $this;
	}

	/**
	 * Get Visual Composer
	 *
	 * @return boolean
	 */
	public function get_visual_composer() {
		return $this->visual_composer;
	}

	/**
	 * Set BeTheme Responsive
	 *
	 * @param  boolean $active Is BeTheme Responsive Active?
	 * @return object
	 */
	public function set_betheme_responsive( $active ) {
		$this->betheme_responsive = $active;

		return $this;
	}

	/**
	 * Get BeTheme Responsive
	 *
	 * @return boolean
	 */
	public function get_betheme_responsive() {
		return $this->betheme_responsive;
	}

	/**
	 * Get tables
	 *
	 * @return array
	 */
	public function get_tables() {
		$tables = array();

		$result = $this->query( "SHOW TABLES FROM `{$this->wpdb->dbname}`" );
		while ( $row = $this->fetch_row( $result ) ) {
			if ( isset( $row[0] ) && ( $table_name = $row[0] ) ) {

				// Include table prefixes
				if ( $this->get_include_table_prefixes() ) {
					$include = false;

					// Check table prefixes
					foreach ( $this->get_include_table_prefixes() as $prefix ) {
						if ( stripos( $table_name, $prefix ) === 0 ) {
							$include = true;
							break;
						}
					}

					// Skip current table
					if ( $include === false ) {
						continue;
					}
				}

				// Exclude table prefixes
				if ( $this->get_exclude_table_prefixes() ) {
					$exclude = false;

					// Check table prefixes
					foreach ( $this->get_exclude_table_prefixes() as $prefix ) {
						if ( stripos( $table_name, $prefix ) === 0 ) {
							$exclude = true;
							break;
						}
					}

					// Skip current table
					if ( $exclude === true ) {
						continue;
					}
				}

				// Add table name
				$tables[] = $table_name;
			}
		}

		// Close result cursor
		$this->free_result( $result );

		return $tables;
	}

	/**
	 * Export database into a file
	 *
	 * @param  string  $file_name    File name
	 * @param  integer $table_index  Table index
	 * @param  integer $table_offset Table offset
	 * @return boolean
	 */
	public function export( $file_name, &$table_index = 0, &$table_offset = 0 ) {
		// Set file handler
		$file_handler = ai1wm_open( $file_name, 'ab' );

		// Write headers
		if ( $table_index === 0 ) {
			ai1wm_write( $file_handler, $this->get_header() );
		}

		// Start time
		$start = microtime( true );

		// Flag to hold if all tables have been processed
		$completed = true;

		// Set SQL Mode
		$this->query( "SET SESSION sql_mode = ''" );

		// Get tables
		$tables = $this->get_tables();

		// Export tables
		for ( ; $table_index < count( $tables ); ) {

			// Get table name
			$table_name = $tables[ $table_index ];

			// Replace table name prefixes
			$new_table_name = $this->replace_table_prefixes( $table_name, 0 );

			// Get create table statement
			if ( $table_offset === 0 ) {

				// Write table drop statement
				$drop_table = "\nDROP TABLE IF EXISTS `{$new_table_name}`;\n";

				// Write table statement
				ai1wm_write( $file_handler, $drop_table );

				// Get create table statement
				$create_table = $this->get_create_table( $table_name );

				// Replace create table prefixes
				$create_table = $this->replace_table_prefixes( $create_table, 14 );

				// Replace table constraints
				$create_table = $this->replace_table_constraints( $create_table );

				// Replace create table options
				$create_table = $this->replace_table_options( $create_table );

				// Write table statement
				ai1wm_write( $file_handler, $create_table );

				// Write end of statement
				ai1wm_write( $file_handler, ";\n\n" );
			}

			// Get primary keys
			$primary_keys = $this->get_primary_keys( $table_name );

			do {

				// Set query
				if ( $primary_keys ) {

					// Set table keys
					$table_keys = array();
					foreach ( $primary_keys as $key ) {
						$table_keys[] = sprintf( '`%s`', $key );
					}

					$table_keys = implode( ', ', $table_keys );

					// Set table where clauses
					$table_where = array( 1 );
					foreach ( $this->get_table_where_clauses( $table_name ) as $clause ) {
						$table_where[] = $clause;
					}

					$table_where = implode( ' AND ', $table_where );

					// Set query with offset and rows count
					$query = sprintf( 'SELECT t1.* FROM `%s` AS t1 JOIN (SELECT %s FROM `%s` WHERE %s ORDER BY %s LIMIT %d, %d) AS t2 USING (%s)', $table_name, $table_keys, $table_name, $table_where, $table_keys, $table_offset, 1000, $table_keys );

				} else {

					// Set table keys
					$table_keys = 1;

					// Set table where clauses
					$table_where = array( 1 );
					foreach ( $this->get_table_where_clauses( $table_name ) as $clause ) {
						$table_where[] = $clause;
					}

					$table_where = implode( ' AND ', $table_where );

					// Set query with offset and rows count
					$query = sprintf( 'SELECT * FROM `%s` WHERE %s ORDER BY %s LIMIT %d, %d', $table_name, $table_where, $table_keys, $table_offset, 1000 );
				}

				// Apply additional table prefix columns
				$columns = $this->get_table_prefix_columns( $table_name );

				// Run SQL query
				$result = $this->query( $query );

				// Repair table data
				if ( $this->errno() === 1194 ) {

					// Current table is marked as crashed and should be repaired
					$this->repair_table( $table_name );

					// Run SQL query
					$result = $this->query( $query );
				}

				// Generate insert statements
				if ( $num_rows = $this->num_rows( $result ) ) {

					// Loop over table rows
					while ( $row = $this->fetch_assoc( $result ) ) {

						// Write start transaction
						if ( $table_offset % Ai1wm_Database::QUERIES_PER_TRANSACTION === 0 ) {
							ai1wm_write( $file_handler, "START TRANSACTION;\n" );
						}

						$items = array();
						foreach ( $row as $key => $value ) {
							// Replace table prefix columns
							if ( isset( $columns[ strtolower( $key ) ] ) ) {
								$value = $this->replace_column_prefixes( $value, 0 );
							}

							// Replace table values
							$items[] = is_null( $value ) ? 'NULL' : "'" . $this->escape( $value ) . "'";
						}

						// Set table values
						$table_values = implode( ',', $items );

						// Set insert statement
						$table_insert = "INSERT INTO `{$new_table_name}` VALUES ({$table_values});\n";

						// Write insert statement
						ai1wm_write( $file_handler, $table_insert );

						// Set current table offset
						$table_offset++;

						// Write end of transaction
						if ( $table_offset % Ai1wm_Database::QUERIES_PER_TRANSACTION === 0 ) {
							ai1wm_write( $file_handler, "COMMIT;\n" );
						}
					}
				} else {

					// Write end of transaction
					if ( $table_offset % Ai1wm_Database::QUERIES_PER_TRANSACTION !== 0 ) {
						ai1wm_write( $file_handler, "COMMIT;\n" );
					}

					// Set curent table index
					$table_index++;

					// Set current table offset
					$table_offset = 0;
				}

				// Close result cursor
				$this->free_result( $result );

				// Time elapsed
				if ( ( $timeout = apply_filters( 'ai1wm_completed_timeout', 10 ) ) ) {
					if ( ( microtime( true ) - $start ) > $timeout ) {
						$completed = false;
						break 2;
					}
				}
			} while ( $num_rows > 0 );
		}

		// Close file handler
		ai1wm_close( $file_handler );

		return $completed;
	}

	/**
	 * Import database from a file
	 *
	 * @param  string  $file_name    File name
	 * @param  integer $query_offset Query offset
	 * @return boolean
	 */
	public function import( $file_name, &$query_offset = 0 ) {
		// Set max allowed packet
		$max_allowed_packet = $this->get_max_allowed_packet();

		// Set file handler
		$file_handler = ai1wm_open( $file_name, 'r' );

		// Start time
		$start = microtime( true );

		// Flag to hold if all tables have been processed
		$completed = true;

		// Set SQL Mode
		$this->query( "SET SESSION sql_mode = ''" );

		// Set file pointer at the query offset
		if ( fseek( $file_handler, $query_offset ) !== -1 ) {
			$query = null;

			// Start transaction
			$this->query( 'START TRANSACTION' );

			// Read database file line by line
			while ( ( $line = fgets( $file_handler ) ) !== false ) {
				$query .= $line;

				// End of query
				if ( preg_match( '/;\s*$/S', $query ) ) {
					$query = trim( $query );

					// Check max allowed packet
					if ( strlen( $query ) <= $max_allowed_packet ) {

						// Replace table prefixes
						$query = $this->replace_table_prefixes( $query );

						// Replace table collations
						$query = $this->replace_table_collations( $query );

						// Replace table values
						$query = $this->replace_table_values( $query );

						// Replace raw values
						$query = $this->replace_raw_values( $query );

						// Run SQL query
						$this->query( $query );

						// Replace table engines (Azure)
						if ( $this->errno() === 1030 ) {

							// Replace table engines
							$query = $this->replace_table_engines( $query );

							// Run SQL query
							$this->query( $query );
						}

						// Set query offset
						$query_offset = ftell( $file_handler );

						// Time elapsed
						if ( ( $timeout = apply_filters( 'ai1wm_completed_timeout', 10 ) ) ) {
							if ( ! $this->is_atomic_query( $query ) ) {
								if ( ( microtime( true ) - $start ) > $timeout ) {
									$completed = false;
									break;
								}
							}
						}
					}

					$query = null;
				}
			}

			// End transaction
			$this->query( 'COMMIT' );
		}

		// Close file handler
		ai1wm_close( $file_handler );

		return $completed;
	}

	/**
	 * Flush database
	 *
	 * @return void
	 */
	public function flush() {
		foreach ( $this->get_tables() as $table_name ) {
			$this->query( "DROP TABLE IF EXISTS `{$table_name}`" );
		}
	}

	/**
	 * Get MySQL version
	 *
	 * @return string
	 */
	protected function get_version() {
		$result = $this->query( "SHOW VARIABLES LIKE 'version'" );
		$row    = $this->fetch_assoc( $result );

		// Close result cursor
		$this->free_result( $result );

		// Get version
		if ( isset( $row['Value'] ) ) {
			return $row['Value'];
		}
	}

	/**
	 * Get MySQL max allowed packet
	 *
	 * @return integer
	 */
	protected function get_max_allowed_packet() {
		$result = $this->query( "SHOW VARIABLES LIKE 'max_allowed_packet'" );
		$row    = $this->fetch_assoc( $result );

		// Close result cursor
		$this->free_result( $result );

		// Get max allowed packet
		if ( isset( $row['Value'] ) ) {
			return $row['Value'];
		}
	}

	/**
	 * Get MySQL collation name
	 *
	 * @param  string $collation_name Collation name
	 * @return string
	 */
	protected function get_collation( $collation_name ) {
		$result = $this->query( "SHOW COLLATION LIKE '{$collation_name}'" );
		$row    = $this->fetch_assoc( $result );

		// Close result cursor
		$this->free_result( $result );

		// Get collation name
		if ( isset( $row['Collation'] ) ) {
			return $row['Collation'];
		}
	}

	/**
	 * Get MySQL create table
	 *
	 * @param  string $table_name Table name
	 * @return string
	 */
	protected function get_create_table( $table_name ) {
		$result = $this->query( "SHOW CREATE TABLE `{$table_name}`" );
		$row    = $this->fetch_assoc( $result );

		// Close result cursor
		$this->free_result( $result );

		// Get create table
		if ( isset( $row['Create Table'] ) ) {
			return $row['Create Table'];
		}
	}

	/**
	 * Repair MySQL table
	 *
	 * @param  string $table_name Table name
	 * @return void
	 */
	protected function repair_table( $table_name ) {
		$this->query( "REPAIR TABLE `{$table_name}`" );
	}

	/**
	 * Get MySQL primary keys
	 *
	 * @param  string $table_name Table name
	 * @return array
	 */
	protected function get_primary_keys( $table_name ) {
		$primary_keys = array();

		// Get primary keys
		$result = $this->query( "SHOW KEYS FROM `{$table_name}` WHERE `Key_name` = 'PRIMARY'" );
		while ( $row = $this->fetch_assoc( $result ) ) {
			if ( isset( $row['Column_name'] ) ) {
				$primary_keys[] = $row['Column_name'];
			}
		}

		// Close result cursor
		$this->free_result( $result );

		return $primary_keys;
	}

	/**
	 * Get MySQL unique keys
	 *
	 * @param  string $table_name Table name
	 * @return array
	 */
	protected function get_unique_keys( $table_name ) {
		$unique_keys = array();

		// Get unique keys
		$result = $this->query( "SHOW KEYS FROM `{$table_name}` WHERE `Non_unique` = 0" );
		while ( $row = $this->fetch_assoc( $result ) ) {
			if ( isset( $row['Column_name'] ) ) {
				$unique_keys[] = $row['Column_name'];
			}
		}

		// Close result cursor
		$this->free_result( $result );

		return $unique_keys;
	}

	/**
	 * Replace table prefixes
	 *
	 * @param  string $input    Table value
	 * @param  mixed  $position Replace first occurrence at a specified position
	 * @return string
	 */
	protected function replace_table_prefixes( $input, $position = false ) {
		// Get table prefixes
		$search  = $this->get_old_table_prefixes();
		$replace = $this->get_new_table_prefixes();

		// Replace first occurance at a specified position
		if ( $position !== false ) {
			for ( $i = 0; $i < count( $search ); $i++ ) {
				$current = stripos( $input, $search[ $i ] );
				if ( $current === $position ) {
					$input = substr_replace( $input, $replace[ $i ], $current, strlen( $search[ $i ] ) );
				}
			}

			return $input;
		}

		// Replace all occurrences
		return str_ireplace( $search, $replace, $input );
	}

	/**
	 * Replace column prefixes
	 *
	 * @param  string $input    Column value
	 * @param  mixed  $position Replace first occurrence at a specified position
	 * @return string
	 */
	protected function replace_column_prefixes( $input, $position = false ) {
		// Get column prefixes
		$search  = $this->get_old_column_prefixes();
		$replace = $this->get_new_column_prefixes();

		// Replace first occurance at a specified position
		if ( $position !== false ) {
			for ( $i = 0; $i < count( $search ); $i++ ) {
				$current = stripos( $input, $search[ $i ] );
				if ( $current === $position ) {
					$input = substr_replace( $input, $replace[ $i ], $current, strlen( $search[ $i ] ) );
				}
			}

			return $input;
		}

		// Replace all occurrences
		return str_ireplace( $search, $replace, $input );
	}

	/**
	 * Replace table values
	 *
	 * @param  string $input Table value
	 * @return string
	 */
	protected function replace_table_values( $input ) {
		// Replace base64 encoded values (Visual Composer)
		if ( $this->get_visual_composer() ) {
			$input = preg_replace_callback( '/\[vc_raw_html\](.+?)\[\/vc_raw_html\]/S', array( $this, 'replace_visual_composer_values_callback' ), $input );
		}

		// Replace base64 encoded values (BeTheme Responsive)
		if ( $this->get_betheme_responsive() ) {
			$input = preg_replace_callback( "/'mfn-page-items','(.*?)'/S", array( $this, 'replace_betheme_responsive_values_callback' ), $input );
		}

		// Replace serialized values
		foreach ( $this->get_old_replace_values() as $old_value ) {
			if ( strpos( $input, $this->escape( $old_value ) ) !== false ) {
				$input = preg_replace_callback( "/'(.*?)(?<!\\\\)'/S", array( $this, 'replace_table_values_callback' ), $input );
				break;
			}
		}

		return $input;
	}

	/**
	 * Replace table values callback
	 *
	 * @param  array  $matches List of matches
	 * @return string
	 */
	protected function replace_table_values_callback( $matches ) {
		// Unescape MySQL special characters
		$input = Ai1wm_Database_Utility::unescape_mysql( $matches[1] );

		// Replace serialized values
		$input = Ai1wm_Database_Utility::replace_serialized_values( $this->get_old_replace_values(), $this->get_new_replace_values(), $input );

		// Escape MySQL special characters
		return "'" . Ai1wm_Database_Utility::escape_mysql( $input ) . "'";
	}

	/**
	 * Replace base64 values callback (Visual Composer)
	 *
	 * @param  array  $matches List of matches
	 * @return string
	 */
	protected function replace_visual_composer_values_callback( $matches ) {
		// Decode base64 characters
		$input = Ai1wm_Database_Utility::base64_decode( $matches[1] );

		// Replace values
		$input = Ai1wm_Database_Utility::replace_values( $this->get_old_replace_values(), $this->get_new_replace_values(), $input );

		// Encode base64 characters
		return '[vc_raw_html]' . Ai1wm_Database_Utility::base64_encode( $input ) . '[/vc_raw_html]';
	}

	/**
	 * Replace base64 values callback (BeTheme Responsive)
	 *
	 * @param  array  $matches List of matches
	 * @return string
	 */
	protected function replace_betheme_responsive_values_callback( $matches ) {
		// Decode base64 characters
		$input = Ai1wm_Database_Utility::base64_decode( $matches[1] );

		// Replace serialized values
		$input = Ai1wm_Database_Utility::replace_serialized_values( $this->get_old_replace_values(), $this->get_new_replace_values(), $input );

		// Encode base64 characters
		return "'mfn-page-items','" . Ai1wm_Database_Utility::base64_encode( $input ) . "'";
	}

	/**
	 * Replace table collations
	 *
	 * @param  string $input SQL statement
	 * @return string
	 */
	protected function replace_table_collations( $input ) {
		static $search  = array();
		static $replace = array();

		// Replace table collations
		if ( empty( $search ) || empty( $replace ) ) {
			if ( ! $this->wpdb->has_cap( 'utf8mb4_520' ) ) {
				if ( ! $this->wpdb->has_cap( 'utf8mb4' ) ) {
					$search  = array( 'utf8mb4_unicode_520_ci', 'utf8mb4' );
					$replace = array( 'utf8_unicode_ci', 'utf8' );
				} else {
					$search  = array( 'utf8mb4_unicode_520_ci' );
					$replace = array( 'utf8mb4_unicode_ci' );
				}
			}
		}

		return str_replace( $search, $replace, $input );
	}

	/**
	 * Replace raw values
	 *
	 * @param  string $input SQL statement
	 * @return string
	 */
	protected function replace_raw_values( $input ) {
		return Ai1wm_Database_Utility::replace_values( $this->get_old_replace_raw_values(), $this->get_new_replace_raw_values(), $input );
	}

	/**
	 * Replace table constraints
	 *
	 * @param  string $input SQL statement
	 * @return string
	 */
	protected function replace_table_constraints( $input ) {
		$pattern = array(
			'/\s+CONSTRAINT(.+)REFERENCES(.+),/i',
			'/,\s+CONSTRAINT(.+)REFERENCES(.+)/i',
		);

		return preg_replace( $pattern, '', $input );
	}

	/**
	 * Check whether input is START TRANSACTION query
	 *
	 * @param  string  $input SQL statement
	 * @return boolean
	 */
	protected function is_start_transaction_query( $input ) {
		return strpos( $input, 'START TRANSACTION' ) === 0;
	}

	/**
	 * Check whether input is COMMIT query
	 *
	 * @param  string  $input SQL statement
	 * @return boolean
	 */
	protected function is_commit_query( $input ) {
		return strpos( $input, 'COMMIT' ) === 0;
	}

	/**
	 * Check whether input is DROP TABLE query
	 *
	 * @param  string  $input SQL statement
	 * @return boolean
	 */
	protected function is_drop_table_query( $input ) {
		return strpos( $input, 'DROP TABLE' ) === 0;
	}

	/**
	 * Check whether input is CREATE TABLE query
	 *
	 * @param  string  $input SQL statement
	 * @return boolean
	 */
	protected function is_create_table_query( $input ) {
		return strpos( $input, 'CREATE TABLE' ) === 0;
	}

	/**
	 * Check whether input is INSERT INTO query
	 *
	 * @param  string  $input SQL statement
	 * @param  string  $table Table name (case insensitive)
	 * @return boolean
	 */
	protected function is_insert_into_query( $input, $table ) {
		return stripos( $input, sprintf( 'INSERT INTO `%s`', $table ) ) === 0;
	}

	/**
	 * Check whether input is atomic query
	 *
	 * @param  string  $input SQL statement
	 * @return boolean
	 */
	protected function is_atomic_query( $input ) {
		$atomic = false;

		// Skip timeout based on table query
		switch ( true ) {
			case $this->is_drop_table_query( $input ):
			case $this->is_create_table_query( $input ):
			case $this->is_start_transaction_query( $input ):
			case $this->is_commit_query( $input ):
				$atomic = true;
				break;

			default:
				// Skip timeout based on table query and table name
				foreach ( $this->get_atomic_tables() as $table_name ) {
					if ( $this->is_insert_into_query( $input, $table_name ) ) {
						$atomic = true;
						break;
					}
				}
		}

		return $atomic;
	}

	/**
	 * Replace table options
	 *
	 * @param  string $input SQL statement
	 * @return string
	 */
	protected function replace_table_options( $input ) {
		// Set table replace options
		$search  = array(
			'TYPE=InnoDB',
			'TYPE=MyISAM',
			'ENGINE=Aria',
			'TRANSACTIONAL=0',
			'TRANSACTIONAL=1',
			'PAGE_CHECKSUM=0',
			'PAGE_CHECKSUM=1',
			'TABLE_CHECKSUM=0',
			'TABLE_CHECKSUM=1',
			'ROW_FORMAT=PAGE',
			'ROW_FORMAT=FIXED',
			'ROW_FORMAT=DYNAMIC',
		);
		$replace = array(
			'ENGINE=InnoDB',
			'ENGINE=MyISAM',
			'ENGINE=MyISAM',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
		);

		return str_ireplace( $search, $replace, $input );
	}

	/**
	 * Replace table engines
	 *
	 * @param  string $input SQL statement
	 * @return string
	 */
	protected function replace_table_engines( $input ) {
		// Set table replace engines
		$search  = array(
			'ENGINE=MyISAM',
			'ENGINE=Aria',
		);
		$replace = array(
			'ENGINE=InnoDB',
			'ENGINE=InnoDB',
		);

		return str_ireplace( $search, $replace, $input );
	}

	/**
	 * Returns header for dump file
	 *
	 * @return string
	 */
	protected function get_header() {
		// Some info about software, source and time
		$header = sprintf(
			"-- All In One WP Migration SQL Dump\n" .
			"-- https://servmask.com/\n" .
			"--\n" .
			"-- Host: %s\n" .
			"-- Database: %s\n" .
			"-- Class: %s\n" .
			"--\n",
			$this->wpdb->dbhost,
			$this->wpdb->dbname,
			get_class( $this )
		);

		return $header;
	}

	/**
	 * Run MySQL query
	 *
	 * @param  string   $input SQL query
	 * @return resource
	 */
	abstract public function query( $input );

	/**
	 * Escape string input for mysql query
	 *
	 * @param  string $input String to escape
	 * @return string
	 */
	abstract public function escape( $input );

	/**
	 * Return the error code for the most recent function call
	 *
	 * @return integer
	 */
	abstract public function errno();

	/**
	 * Return a string description of the last error
	 *
	 * @return string
	 */
	abstract public function error();

	/**
	 * Return server version
	 *
	 * @return string
	 */
	abstract public function version();

	/**
	 * Return the result from MySQL query as associative array
	 *
	 * @param  resource $result MySQL resource
	 * @return array
	 */
	abstract public function fetch_assoc( $result );

	/**
	 * Return the result from MySQL query as row
	 *
	 * @param  resource $result MySQL resource
	 * @return array
	 */
	abstract public function fetch_row( $result );

	/**
	 * Return the number for rows from MySQL results
	 *
	 * @param  resource $result MySQL resource
	 * @return integer
	 */
	abstract public function num_rows( $result );

	/**
	 * Free MySQL result memory
	 *
	 * @param  resource $result MySQL resource
	 * @return boolean
	 */
	abstract public function free_result( $result );
}
