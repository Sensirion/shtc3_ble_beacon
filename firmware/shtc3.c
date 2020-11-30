#include "shtc3.h"

/**
 * @brief TWI events handler.
 */
void twi_handler(nrf_drv_twi_evt_t const * p_event, void * p_context)
{
    switch (p_event->type)
    {
        case NRF_DRV_TWI_EVT_DONE:
            if (p_event->xfer_desc.type == NRF_DRV_TWI_XFER_RX)
            {
                //data_handler(m_sample);
            }
            m_xfer_done = true;
            break;
        default:
            break;
    }
}

/**
 * @brief UART initialization.
 */
void twi_init (void)
{
    ret_code_t err_code;

    const nrf_drv_twi_config_t twi_shtc3_config = {
       .scl                = 14,
       .sda                = 13,
       .frequency          = NRF_TWI_FREQ_100K,
       .interrupt_priority = APP_IRQ_PRIORITY_HIGH,
       .clear_bus_init     = false
    };

    err_code = nrf_drv_twi_init(&m_twi, &twi_shtc3_config, twi_handler, NULL);
    APP_ERROR_CHECK(err_code);

    nrf_drv_twi_enable(&m_twi);
}

void shtc3_start_measurement(void)
{
    m_xfer_done = false;
    ret_code_t err_code;

    uint8_t reg[2] = {0x78, 0x66};
    err_code = nrf_drv_twi_tx(&m_twi, SHTC3_ADDRESS, reg, sizeof(reg), false);
    APP_ERROR_CHECK(err_code);
    while (m_xfer_done == false); 
}

void shtc3_read_measurement(void)
{
    ret_code_t err_code;
    m_xfer_done = false;

    // read 6 bytes from sensor with RH[2], CRC, T[2], CRC
    err_code = nrf_drv_twi_rx(&m_twi, SHTC3_ADDRESS, (uint8_t*) &m_sample, sizeof(m_sample));
    APP_ERROR_CHECK(err_code);
    while (m_xfer_done == false); 
}

uint8_t CalculateCrc(uint8_t data[], uint8_t numBytes)
{
  uint8_t bit; /* bit mask */
  uint8_t crc = 0xFFu; /* calculated checksum */
  uint8_t byteCtr; /* byte counter */
  
  /* calculates 8-bit checksum with given polynomial */
  for(byteCtr = 0; byteCtr < numBytes; byteCtr++) {
    crc ^= (data[byteCtr]);
    for(bit = 8u; bit > 0u; --bit) {
      if(0 < (crc & 0x80u)) {
        crc = (crc << 1u) ^ POLYNOMIAL;
      } else {
        crc = (crc << 1u);
      }
    }
  }
	
  return crc;
}

ret_code_t shtc3_get_rht_raw(uint16_t* humidityticks, uint16_t* temperatureticks)
{
    	ret_code_t err_code = 0;

	*temperatureticks = (((uint16_t)m_sample[0]<<8) + m_sample[1]);
	*humidityticks = (((uint16_t)m_sample[3]<<8) + m_sample[4]);
	
	uint8_t crcHumiExpected = CalculateCrc(&m_sample[3], 2u);
	uint8_t crcTemperatureExpected = CalculateCrc(&m_sample[0], 2u);

	if(crcHumiExpected != m_sample[5] || crcTemperatureExpected != m_sample[2])
	{
            err_code=-1;
        }

        return err_code;
}
